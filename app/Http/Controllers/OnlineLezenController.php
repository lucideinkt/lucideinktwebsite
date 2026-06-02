<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPdfPage;
use App\Services\SEOService;
use Illuminate\Http\Request;

class OnlineLezenController extends Controller
{
    /**
     * Display the online reading library
     */
    public function index()
    {
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        $products = Product::with(['category', 'productCopy'])
            ->withCount('bookPages')
            ->where(function ($q) use ($isAdmin) {
                $q->whereNotNull('pdf_file')->where('pdf_file', '!=', '')
                  ->orWhere(function ($q2) {
                      $q2->whereNotNull('book_content')->where('book_content', '!=', '');
                  })
                  ->orWhere(function ($q3) use ($isAdmin) {
                      $q3->whereHas('bookPages');
                      // Non-admins only see published book content
                      if (!$isAdmin) {
                          $q3->where('book_content_published', true);
                      }
                  });
            })
            ->orderBy('title', 'asc')
            ->get()
            ->sort(function ($a, $b) use ($isAdmin) {
                // Tier 0 = HTML, Tier 1 = PDF-enabled, Tier 2 = Binnenkort Online
                $aHtml = $a->book_pages_count > 0 && ($isAdmin || $a->book_content_published);
                $bHtml = $b->book_pages_count > 0 && ($isAdmin || $b->book_content_published);
                $aPdf  = !$aHtml && !empty($a->pdf_file) && $a->pdf_reader_enabled;
                $bPdf  = !$bHtml && !empty($b->pdf_file) && $b->pdf_reader_enabled;

                $aTier = $aHtml ? 0 : ($aPdf ? 1 : 2);
                $bTier = $bHtml ? 0 : ($bPdf ? 1 : 2);

                if ($aTier !== $bTier) {
                    return $aTier <=> $bTier;
                }

                // Within HTML tier: "Herzameling" comes first
                if ($aHtml && $bHtml) {
                    $aFirst = str_contains(strtolower($a->title), 'herzameling');
                    $bFirst = str_contains(strtolower($b->title), 'herzameling');
                    if ($aFirst !== $bFirst) {
                        return $aFirst ? -1 : 1;
                    }
                }

                return strcmp($a->title, $b->title);
            })
            ->values();

        return view('online-lezen', [
            'products'   => $products,
            'categories' => ProductCategory::orderBy('name')->get(['id', 'name']),
            'SEOData'    => SEOService::getPageSEO('online-lezen'),
            'isAdmin'    => $isAdmin,
        ]);
    }

    /**
     * Display the reader for a specific book.
     *
     * Rules:
     *  - If the book has published HTML pages → always redirect to the HTML reader (/lees).
     *  - If the book has a PDF reader enabled  → always show the fullscreen PDF reader.
     *  - Otherwise                             → 404 (nothing to show publicly).
     *
     * The non-fullscreen "normal page" layout (online-lezen-reader.blade.php) is intentionally
     * never rendered here so that the plain product page cannot be reached by users or crawlers.
     */
    public function read(Request $request, $slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        $isAdminRead = auth()->check() && auth()->user()->role === 'admin';

        // 1. HTML reader takes priority — redirect if content is available
        if ($product->bookPages()->exists() && ($isAdminRead || $product->book_content_published)) {
            return redirect()->route('onlineLezenReadHtml', $slug);
        }

        // 2. PDF reader — show fullscreen reader whenever a PDF file exists.
        //    pdf_reader_enabled only controls visibility in the library listing, not URL access.
        if (!empty($product->pdf_file)) {
            return view('online-lezen-reader-fullscreen', [
                'product' => $product,
                'SEOData' => SEOService::getProductSEO($product, 'online-lezen'),
            ]);
        }

        // 3. No content available → redirect to library index (better for SEO than 404)
        return redirect()->route('onlineLezen', [], 301);
    }

    /**
     * Schone HTML lezer pagina — laadt alle pagina's server-side to disable lazy loading
     */
    public function readHtml($slug)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        // Block non-admins when book content is unpublished
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
        if (!$isAdmin && !$product->book_content_published) {
            abort(404);
        }

        // Render all pages server-side for immediate availability in the reader
        $initialPages = $product->bookPages()->orderBy('page_number')->get();

        abort_if($initialPages->isEmpty(), 404);

        // All page numbers + book_title for dropdown + progress bar (lightweight)
        $allPageMeta = $product->bookPages()
            ->orderBy('page_number')
            ->get(['page_number', 'book_title']);

        return view('online-lezen-html-reader', [
            'product'      => $product,
            'pages'        => $initialPages,
            'allPageMeta'  => $allPageMeta,
            'tocEntries'   => config('book_toc.' . $slug, []),
            'SEOData'      => SEOService::getProductSEO($product, 'online-lezen-html'),
        ]);
    }

    /**
     * JSON API — zoek in alle boeken tegelijk (cross-book full-text search)
     * Searches both HTML book pages and indexed PDF text content.
     */
    public function searchAllBooks(Request $request)
    {
        $query = trim($request->query('q', ''));
        if (mb_strlen($query) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        $isAdmin = auth()->check() && auth()->user()->role === 'admin';

        $allResults = [];
        $normalizedQuery = self::removeDiacritics(mb_strtolower($query));
        $maxPerBook = 3;   // max snippets per book
        $maxTotal   = 40;  // hard cap

        // ── 1. Search HTML book pages ─────────────────────────────────────────
        $htmlProducts = Product::withCount('bookPages')
            ->having('book_pages_count', '>', 0)
            ->when(!$isAdmin, fn($q) => $q->where('book_content_published', true))
            ->get(['id', 'title', 'slug', 'book_content_published']);

        // Collect product IDs that have an active HTML version — these will be excluded from PDF search
        $htmlProductIds = $htmlProducts->pluck('id')->all();

        foreach ($htmlProducts as $product) {
            if (count($allResults) >= $maxTotal) break;

            $readerUrl = route('onlineLezenReadHtml', $product->slug);
            $pages = $product->bookPages()
                ->orderBy('page_number')
                ->get(['page_number', 'content']);

            $bookCount = 0;
            foreach ($pages as $page) {
                if ($bookCount >= $maxPerBook) break;
                if (count($allResults) >= $maxTotal) break;

                $content = preg_replace('/<[^>]*class="[^"]*page-number[^"]*"[^>]*>.*?<\/[^>]+>/is', '', $page->content);
                $content = preg_replace('/<button[^>]*>.*?<\/button>/is', '', $content);
                $plain   = html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $plain   = preg_replace('/\s+/', ' ', trim($plain));

                $normalizedPlain = self::removeDiacritics(mb_strtolower($plain));
                $pos = mb_strpos($normalizedPlain, $normalizedQuery);
                if ($pos === false) continue;

                $snippetStart = max(0, $pos - 70);
                $snippetEnd   = min(mb_strlen($plain), $pos + mb_strlen($query) + 70);
                $snippet      = ($snippetStart > 0 ? '…' : '')
                    . mb_substr($plain, $snippetStart, $pos - $snippetStart)
                    . '[[HIT]]'
                    . mb_substr($plain, $pos, mb_strlen($query))
                    . '[[/HIT]]'
                    . mb_substr($plain, $pos + mb_strlen($query), $snippetEnd - $pos - mb_strlen($query))
                    . ($snippetEnd < mb_strlen($plain) ? '…' : '');

                $allResults[] = [
                    'productId'    => $product->id,
                    'productTitle' => $product->title,
                    'readerUrl'    => $readerUrl,
                    'page'         => $page->page_number,
                    'snippet'      => $snippet,
                    'type'         => 'html',
                ];
                $bookCount++;
            }
        }

        // ── 2. Search indexed PDF pages ───────────────────────────────────
        // Only search PDF for products that do NOT have a published HTML version.
        // If a book has an active HTML version, HTML takes priority and PDF is skipped.
        $pdfProducts = Product::whereNotNull('pdf_file')
            ->where('pdf_file', '!=', '')
            ->where('pdf_reader_enabled', true)
            ->whereHas('pdfPages')
            ->whereNotIn('id', $htmlProductIds)
            ->get(['id', 'title', 'slug']);

        foreach ($pdfProducts as $product) {
            if (count($allResults) >= $maxTotal) break;

            $readerUrl = route('onlineLezenRead', $product->slug);

            $pages = $product->pdfPages()
                ->orderBy('page_number')
                ->get(['page_number', 'content']);

            $bookCount = 0;
            foreach ($pages as $page) {
                if ($bookCount >= $maxPerBook) break;
                if (count($allResults) >= $maxTotal) break;

                $plain           = $page->content ?? '';
                $normalizedPlain = self::removeDiacritics(mb_strtolower($plain));
                $pos             = mb_strpos($normalizedPlain, $normalizedQuery);
                if ($pos === false) continue;

                $snippetStart = max(0, $pos - 70);
                $snippetEnd   = min(mb_strlen($plain), $pos + mb_strlen($query) + 70);
                $snippet      = ($snippetStart > 0 ? '…' : '')
                    . mb_substr($plain, $snippetStart, $pos - $snippetStart)
                    . '[[HIT]]'
                    . mb_substr($plain, $pos, mb_strlen($query))
                    . '[[/HIT]]'
                    . mb_substr($plain, $pos + mb_strlen($query), $snippetEnd - $pos - mb_strlen($query))
                    . ($snippetEnd < mb_strlen($plain) ? '…' : '');

                $allResults[] = [
                    'productId'    => $product->id,
                    'productTitle' => $product->title,
                    'readerUrl'    => $readerUrl,
                    'page'         => $page->page_number,
                    'snippet'      => $snippet,
                    'type'         => 'pdf',
                ];
                $bookCount++;
            }
        }

        return response()->json([
            'results' => $allResults,
            'total'   => count($allResults),
            'query'   => $query,
        ]);
    }
    public function searchApi($slug, Request $request)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        $query = trim($request->query('q', ''));
        if (mb_strlen($query) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        // Strip diacritics for more forgiving search (Nursi finds Nursî etc.)
        // We search both the raw query AND a normalized version
        $pages = $product->bookPages()
            ->orderBy('page_number')
            ->get(['page_number', 'content']);

        $results = [];
        $normalizedQuery = self::removeDiacritics(mb_strtolower($query));

        foreach ($pages as $page) {
            // Remove page-number elements and button elements before extracting text
            $content = preg_replace('/<[^>]*class="[^"]*page-number[^"]*"[^>]*>.*?<\/[^>]+>/is', '', $page->content);
            $content = preg_replace('/<button[^>]*>.*?<\/button>/is', '', $content);
            // Strip HTML tags to get plain text
            $plain = html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            // Normalize whitespace
            $plain = preg_replace('/\s+/', ' ', trim($plain));

            $normalizedPlain = self::removeDiacritics(mb_strtolower($plain));
            $pos = mb_strpos($normalizedPlain, $normalizedQuery);

            if ($pos === false) continue;

            // Find all occurrences
            $offset = 0;
            while (($pos = mb_strpos($normalizedPlain, $normalizedQuery, $offset)) !== false) {
                $snippetStart = max(0, $pos - 60);
                $snippetEnd   = min(mb_strlen($plain), $pos + mb_strlen($query) + 60);
                $snippet      = ($snippetStart > 0 ? '…' : '')
                    . mb_substr($plain, $snippetStart, $pos - $snippetStart)
                    . '[[HIT]]'
                    . mb_substr($plain, $pos, mb_strlen($query))
                    . '[[/HIT]]'
                    . mb_substr($plain, $pos + mb_strlen($query), $snippetEnd - $pos - mb_strlen($query))
                    . ($snippetEnd < mb_strlen($plain) ? '…' : '');

                $results[] = [
                    'page'    => $page->page_number,
                    'snippet' => $snippet,
                ];
                $offset = $pos + 1;
                if (count($results) >= 100) break 2; // max 100 results total
            }
        }

        return response()->json([
            'results' => $results,
            'total'   => count($results),
        ]);
    }

    /**
     * Remove diacritics/accents for accent-insensitive search
     */
    private static function removeDiacritics(string $str): string
    {
        $map = [
            'à'=>'a','á'=>'a','â'=>'a','ã'=>'a','ä'=>'a','å'=>'a','ā'=>'a','ă'=>'a','ą'=>'a',
            'è'=>'e','é'=>'e','ê'=>'e','ë'=>'e','ē'=>'e','ĕ'=>'e','ę'=>'e','ě'=>'e',
            'ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ī'=>'i','ĭ'=>'i','į'=>'i',
            'ò'=>'o','ó'=>'o','ô'=>'o','õ'=>'o','ö'=>'o','ō'=>'o','ŏ'=>'o','ő'=>'o',
            'ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ū'=>'u','ŭ'=>'u','ů'=>'u','ű'=>'u',
            'ç'=>'c','ć'=>'c','ĉ'=>'c','č'=>'c',
            'ñ'=>'n','ń'=>'n','ň'=>'n',
            'ş'=>'s','ś'=>'s','ŝ'=>'s','š'=>'s',
            'ž'=>'z','ź'=>'z','ż'=>'z',
            'ğ'=>'g','ĝ'=>'g','ġ'=>'g','ģ'=>'g',
            'ý'=>'y','ÿ'=>'y',
            'ß'=>'ss',
        ];
        return strtr($str, $map);
    }

    /**
     * JSON API — geeft pagina's terug na een bepaald paginanummer
     */
    public function pagesApi($slug, Request $request)
    {
        $product = Product::where('slug', '=', $slug)->firstOrFail();

        $after = (int) $request->query('after', 0);
        $limit = min((int) $request->query('limit', 10), 20); // max 20 per request

        $pages = $product->bookPages()
            ->orderBy('page_number')
            ->where('page_number', '>', $after)
            ->limit($limit)
            ->get(['page_number', 'content']);

        return response()->json([
            'pages'    => $pages,
            'has_more' => $product->bookPages()->where('page_number', '>', $after)->count() > $limit,
        ]);
    }
}
