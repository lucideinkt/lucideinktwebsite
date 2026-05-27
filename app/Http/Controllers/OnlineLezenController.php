<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
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
     * Display the PDF reader for a specific book
     */
    public function read(Request $request, $slug)
    {
        $product = Product::where('slug', '=', $slug)
            ->firstOrFail();

        // Als product HTML pagina's heeft → stuur door naar schone HTML lezer
        // Maar alleen als het content gepubliceerd is of de gebruiker admin is
        $isAdminRead = auth()->check() && auth()->user()->role === 'admin';
        if ($product->bookPages()->exists() && ($isAdminRead || $product->book_content_published)) {
            return redirect()->route('onlineLezenReadHtml', $slug);
        }

        // Check if fullscreen mode is requested, or default to fullscreen when opened from library (pdf_reader_enabled)
        $isFullscreen = $request->query('fullscreen') === '1' || $product->pdf_reader_enabled;

        // Use fullscreen layout if parameter is present or PDF reader is enabled
        $view = $isFullscreen ? 'online-lezen-reader-fullscreen' : 'online-lezen-reader';

        return view($view, [
            'product' => $product,
            'SEOData' => SEOService::getProductSEO($product, 'online-lezen'),
        ]);
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
     */
    public function searchAllBooks(Request $request)
    {
        $query = trim($request->query('q', ''));
        if (mb_strlen($query) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        // Only products that have HTML book pages
        $products = Product::withCount('bookPages')
            ->having('book_pages_count', '>', 0)
            ->get(['id', 'title', 'slug']);

        $allResults = [];
        $normalizedQuery = self::removeDiacritics(mb_strtolower($query));
        $maxPerBook = 3;   // max snippets per book
        $maxTotal   = 40;  // hard cap

        foreach ($products as $product) {
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
