<?php

namespace App\Http\Controllers;

use App\Models\BookPage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookContentController extends Controller
{
    /** Overzicht van alle producten */
    public function index()
    {
        $products = Product::select('id', 'title', 'slug', 'image_1', 'is_published', 'book_content_published', 'pdf_file', 'pdf_reader_enabled')
            ->withCount('bookPages')
            ->orderBy('title')
            ->paginate(20);

        return view('book-content.index', compact('products'));
    }

    /** Editor — toont alle pagina's van één product */
    public function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $pages = $product->bookPages()->orderBy('page_number')->get();
        $bookTitle = $product->bookPages()->value('book_title') ?? '';

        return view('book-content.edit', compact('product', 'pages', 'bookTitle'));
    }

    /** Sla alle pagina's tegelijk op (bulk upsert) */
    public function update(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'book_content_cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'delete_book_content_cover' => ['nullable', 'boolean'],
            'book_content_language' => ['nullable', Rule::in(array_keys(Product::BOOK_CONTENT_LANGUAGES))],
            'book_content_type' => ['nullable', Rule::in(array_keys(Product::BOOK_CONTENT_TYPES))],
        ]);

        $oldCover = $product->book_content_cover;
        if ($request->hasFile('book_content_cover')) {
            $newCover = $request->file('book_content_cover')->store('products/book-content-covers', 'public');
            $product->update(['book_content_cover' => $newCover]);

            if ($oldCover && $oldCover !== $newCover) {
                Storage::disk('public')->delete($oldCover);
            }
        } elseif ($request->boolean('delete_book_content_cover')) {
            $product->update(['book_content_cover' => null]);

            if ($oldCover) {
                Storage::disk('public')->delete($oldCover);
            }
        }

        $incoming = $request->input('pages', []);
        $bookTitle = trim($request->input('book_title', ''));

        $incomingIds = collect($incoming)
            ->map(fn ($p) => (int) ($p['id'] ?? 0))
            ->filter()
            ->values();

        $maxPageNumber = (int) ($product->bookPages()->max('page_number') ?? 0);
        $nextPageNumber = $maxPageNumber + 1;
        $pagesToSave = [];

        foreach ($incoming as $index => $pageData) {
            $content = $pageData['content'] ?? '';
            $pageNumber = (int) ($pageData['page_number'] ?? 0);
            $pageNumber = $this->pageNumberFromContent($content) ?? $pageNumber;

            if ($pageNumber < 1) {
                $pageNumber = $nextPageNumber++;
            }

            $pagesToSave[] = [
                'id' => (int) ($pageData['id'] ?? 0),
                'page_number' => $pageNumber,
                'content' => $content,
            ];
        }

        $targetNumbers = array_column($pagesToSave, 'page_number');
        if (count($targetNumbers) !== count(array_unique($targetNumbers))) {
            throw ValidationException::withMessages([
                'pages' => 'Meerdere pagina’s hebben hetzelfde paginanummer. Controleer de HTML-ID’s.',
            ]);
        }

        DB::transaction(function () use ($product, $incomingIds, $pagesToSave, $bookTitle, $validated): void {
            $product->update(array_intersect_key($validated, array_flip([
                'book_content_language',
                'book_content_type',
            ])));

            if ($incomingIds->isNotEmpty()) {
                $product->bookPages()->whereNotIn('id', $incomingIds)->delete();
            }

            $existingPages = $product->bookPages()->get(['id', 'page_number']);
            $submittedIds = collect($pagesToSave)
                ->pluck('id')
                ->filter()
                ->flip();
            $reservedNumbers = array_fill_keys(array_column($pagesToSave, 'page_number'), true);
            $occupiedNumbers = array_fill_keys($existingPages->pluck('page_number')->all(), true);
            $temporaryNumbers = [];

            for ($number = 1; $number <= 65535 && count($temporaryNumbers) < $submittedIds->count(); $number++) {
                if (! isset($occupiedNumbers[$number]) && ! isset($reservedNumbers[$number])) {
                    $temporaryNumbers[] = $number;
                }
            }

            if (count($temporaryNumbers) < $submittedIds->count()) {
                throw ValidationException::withMessages([
                    'pages' => 'De pagina’s kunnen niet veilig worden hernummerd. Controleer de paginanummers.',
                ]);
            }

            foreach ($submittedIds->keys() as $index => $pageId) {
                $product->bookPages()->whereKey($pageId)->update([
                    'page_number' => $temporaryNumbers[$index],
                ]);
            }

            foreach ($pagesToSave as $pageData) {
                if ($pageData['id']) {
                    $product->bookPages()->whereKey($pageData['id'])->update([
                        'page_number' => $pageData['page_number'],
                        'content' => $pageData['content'],
                        'book_title' => $bookTitle,
                    ]);
                } else {
                    BookPage::create([
                        'product_id' => $product->id,
                        'page_number' => $pageData['page_number'],
                        'content' => $pageData['content'],
                        'book_title' => $bookTitle,
                    ]);
                }
            }
        });

        return redirect()
            ->route('bookContent.edit', $product->id)
            ->with('success', 'Opgeslagen voor "'.$product->title.'".');
    }

    private function pageNumberFromContent(string $content): ?int
    {
        preg_match_all('/<div\b[^>]*>/i', $content, $divs);

        foreach ($divs[0] as $div) {
            if (! preg_match('/\bclass\s*=\s*["\'][^>]*\bpage\b/i', $div)) {
                continue;
            }

            if (preg_match('/\bid\s*=\s*["\']?(\d+)/i', $div, $matches)) {
                return (int) $matches[1];
            }
        }

        return null;
    }

    /** Voeg één nieuwe lege pagina toe (AJAX) */
    public function storePage(Request $request, int $id)
    {
        $product = Product::findOrFail($id);
        $nextNumber = ($product->bookPages()->max('page_number') ?? 0) + 1;
        $bookTitle = $product->bookPages()->value('book_title') ?? '';

        $page = BookPage::create([
            'product_id' => $product->id,
            'page_number' => $nextNumber,
            'content' => '',
            'book_title' => $bookTitle,
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

    /** Schakel book_content_published aan/uit (AJAX) */
    public function togglePublished(int $id)
    {
        $product = Product::findOrFail($id);
        $newValue = ! ((bool) $product->book_content_published);
        $product->update(['book_content_published' => $newValue]);

        return response()->json([
            'ok' => true,
            'published' => $newValue,
        ]);
    }

    /** Schakel pdf_reader_enabled aan/uit (AJAX) */
    public function togglePdfReader(int $id)
    {
        $product = Product::findOrFail($id);
        $newValue = ! ((bool) $product->pdf_reader_enabled);
        $product->update(['pdf_reader_enabled' => $newValue]);

        return response()->json([
            'ok' => true,
            'enabled' => $newValue,
        ]);
    }
}
