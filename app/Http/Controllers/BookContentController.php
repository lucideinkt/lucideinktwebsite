<?php

namespace App\Http\Controllers;

use App\Models\BookPage;
use App\Models\Product;
use Illuminate\Http\Request;

class BookContentController extends Controller
{
    /** Overzicht van alle producten */
    public function index()
    {
        $products = Product::select('id', 'title', 'slug', 'image_1', 'is_published')
            ->withCount('bookPages')
            ->orderBy('title')
            ->paginate(20);

        return view('book-content.index', compact('products'));
    }

    /** Editor — toont alle pagina's van één product */
    public function edit(int $id)
    {
        $product   = Product::findOrFail($id);
        $pages     = $product->bookPages()->orderBy('page_number')->get();
        $bookTitle = $product->bookPages()->value('book_title') ?? '';

        return view('book-content.edit', compact('product', 'pages', 'bookTitle'));
    }

    /** Sla alle pagina's tegelijk op (bulk upsert) */
    public function update(Request $request, int $id)
    {
        $product   = Product::findOrFail($id);
        $incoming  = $request->input('pages', []);
        $bookTitle = trim($request->input('book_title', ''));

        $incomingIds = collect($incoming)
            ->map(fn($p) => (int) ($p['id'] ?? 0))
            ->filter()
            ->values();

        if ($incomingIds->isNotEmpty()) {
            $product->bookPages()->whereNotIn('id', $incomingIds)->delete();
        }

        foreach ($incoming as $index => $pageData) {
            $pageId     = (int) ($pageData['id'] ?? 0);
            $content    = $pageData['content'] ?? '';
            $pageNumber = (int) ($pageData['page_number'] ?? 0);

            if ($pageNumber < 1) {
                if (preg_match('/<div\s[^>]*class="[^"]*\bpage\b[^"]*"[^>]*id="(\d+)"/i', $content, $m)
                 || preg_match('/<div\s[^>]*id="(\d+)"[^>]*class="[^"]*\bpage\b[^"]*"/i', $content, $m)) {
                    $pageNumber = (int) $m[1];
                }
            }

            if ($pageNumber < 1) {
                $pageNumber = (int) $index + 1;
            }

            if ($pageId) {
                BookPage::where('id', $pageId)
                    ->where('product_id', $product->id)
                    ->update([
                        'page_number' => $pageNumber,
                        'content'     => $content,
                        'book_title'  => $bookTitle,
                    ]);
            } else {
                BookPage::create([
                    'product_id'  => $product->id,
                    'page_number' => $pageNumber,
                    'content'     => $content,
                    'book_title'  => $bookTitle,
                ]);
            }
        }

        return redirect()
            ->route('bookContent.edit', $product->id)
            ->with('success', 'Opgeslagen voor "' . $product->title . '".');
    }

    /** Voeg één nieuwe lege pagina toe (AJAX) */
    public function storePage(Request $request, int $id)
    {
        $product    = Product::findOrFail($id);
        $nextNumber = ($product->bookPages()->max('page_number') ?? 0) + 1;
        $bookTitle  = $product->bookPages()->value('book_title') ?? '';

        $page = BookPage::create([
            'product_id'  => $product->id,
            'page_number' => $nextNumber,
            'content'     => '',
            'book_title'  => $bookTitle,
        ]);

        return response()->json(['id' => $page->id, 'page_number' => $nextNumber]);
    }

    /** Verwijder één pagina (AJAX) */
    public function destroyPage(int $productId, int $pageId)
    {
        $page = BookPage::where('product_id', $productId)->findOrFail($pageId);
        $page->delete();

        return response()->json(['ok' => true]);
    }

    /** Herorden pagina's (AJAX — ontvangt array van {id, page_number}) */
    public function reorder(Request $request, int $id)
    {
        $request->validate(['order' => ['required', 'array']]);

        foreach ($request->input('order') as $item) {
            BookPage::where('product_id', $id)
                ->where('id', $item['id'])
                ->update(['page_number' => $item['page_number']]);
        }

        return response()->json(['ok' => true]);
    }
}
