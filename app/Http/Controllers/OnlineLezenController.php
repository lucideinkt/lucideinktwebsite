<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\SEOService;
use Illuminate\Http\Request;

class OnlineLezenController extends Controller
{
    /**
     * Display the online reading library
     */
    public function index()
    {
        $products = Product::with(['category', 'productCopy'])
            ->withCount('bookPages')
            ->where(function ($q) {
                $q->whereNotNull('pdf_file')->where('pdf_file', '!=', '')
                  ->orWhere(function ($q2) {
                      $q2->whereNotNull('book_content')->where('book_content', '!=', '');
                  })
                  ->orWhereHas('bookPages');
            })
            ->orderBy('title', 'asc')
            ->get();

        return view('online-lezen', [
            'products' => $products,
            'SEOData'  => SEOService::getPageSEO('online-lezen'),
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
        if ($product->bookPages()->exists()) {
            return redirect()->route('onlineLezenReadHtml', $slug);
        }

        // Check if fullscreen mode is requested
        $isFullscreen = $request->query('fullscreen') === '1';

        // Use fullscreen layout if parameter is present
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
     * JSON API — zoek in pagina's van een boek
     */
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
