<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class OnlineLezenController extends Controller
{
    public function index()
    {
        $products = Product::withCount('bookPages')
            ->whereHas('bookPages')
            ->where('book_content_published', true)
            ->orderBy('title')
            ->get();

        return view('online-lezen', [
            'products' => $products,
            'categories' => collect(),
            'SEOData' => null,
            'isAdmin' => false,
        ]);
    }

    public function read(string $slug)
    {
        return redirect()->route('onlineLezenReadHtml', $slug);
    }

    public function readHtml(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        abort_if(! $product->book_content_published, 404);

        $initialPages = $product->bookPages()->orderBy('page_number')->get();
        abort_if($initialPages->isEmpty(), 404);

        $allPageMeta = $initialPages->map(fn ($p) => [
            'page_number' => $p->page_number,
            'book_title' => $p->book_title,
        ]);

        return view('online-lezen-html-reader', [
            'product' => $product,
            'pages' => $initialPages,
            'allPageMeta' => $allPageMeta,
            'tocEntries' => config('book_toc.' . $slug, []),
            'SEOData' => null,
        ]);
    }

    public function searchAllBooks(Request $request)
    {
        $query = trim((string) $request->query('q', ''));
        if (mb_strlen($query) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        $results = [];
        $needle = mb_strtolower($query);

        $products = Product::with('bookPages')->where('book_content_published', true)->get();

        foreach ($products as $product) {
            foreach ($product->bookPages as $page) {
                $plain = html_entity_decode(strip_tags((string) $page->content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $plain = preg_replace('/\s+/', ' ', trim($plain));
                $haystack = mb_strtolower($plain);
                $pos = mb_strpos($haystack, $needle);
                if ($pos === false) {
                    continue;
                }

                $start = max(0, $pos - 70);
                $end = min(mb_strlen($plain), $pos + mb_strlen($query) + 70);
                $snippet = ($start > 0 ? '…' : '')
                    . mb_substr($plain, $start, $pos - $start)
                    . '[[HIT]]'
                    . mb_substr($plain, $pos, mb_strlen($query))
                    . '[[/HIT]]'
                    . mb_substr($plain, $pos + mb_strlen($query), $end - $pos - mb_strlen($query))
                    . ($end < mb_strlen($plain) ? '…' : '');

                $results[] = [
                    'productId' => $product->id,
                    'productTitle' => $product->title,
                    'readerUrl' => route('onlineLezenReadHtml', $product->slug),
                    'page' => $page->page_number,
                    'snippet' => $snippet,
                    'type' => 'html',
                ];

                if (count($results) >= 40) {
                    break 2;
                }
            }
        }

        return response()->json(['results' => $results, 'total' => count($results), 'query' => $query]);
    }

    public function searchApi(string $slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $query = trim((string) $request->query('q', ''));
        if (mb_strlen($query) < 2) {
            return response()->json(['results' => [], 'total' => 0]);
        }

        $needle = mb_strtolower($query);
        $results = [];

        foreach ($product->bookPages()->orderBy('page_number')->get(['page_number', 'content']) as $page) {
            $plain = html_entity_decode(strip_tags((string) $page->content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $plain = preg_replace('/\s+/', ' ', trim($plain));
            $haystack = mb_strtolower($plain);
            $offset = 0;

            while (($pos = mb_strpos($haystack, $needle, $offset)) !== false) {
                $start = max(0, $pos - 60);
                $end = min(mb_strlen($plain), $pos + mb_strlen($query) + 60);
                $results[] = [
                    'page' => $page->page_number,
                    'snippet' => ($start > 0 ? '…' : '')
                        . mb_substr($plain, $start, $pos - $start)
                        . '[[HIT]]'
                        . mb_substr($plain, $pos, mb_strlen($query))
                        . '[[/HIT]]'
                        . mb_substr($plain, $pos + mb_strlen($query), $end - $pos - mb_strlen($query))
                        . ($end < mb_strlen($plain) ? '…' : ''),
                ];

                $offset = $pos + 1;
                if (count($results) >= 100) {
                    break 2;
                }
            }
        }

        return response()->json(['results' => $results, 'total' => count($results)]);
    }

    public function pagesApi(string $slug, Request $request)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $after = (int) $request->query('after', 0);
        $limit = min(max((int) $request->query('limit', 10), 1), 20);

        $pages = $product->bookPages()
            ->where('page_number', '>', $after)
            ->orderBy('page_number')
            ->limit($limit)
            ->get(['page_number', 'content']);

        return response()->json([
            'pages' => $pages,
            'has_more' => $product->bookPages()->where('page_number', '>', $after)->count() > $limit,
        ]);
    }
}

