<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AllBooksSearchApiController extends Controller
{
    private const MAX_PER_BOOK = 5;

    private const MAX_TOTAL = 60;

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate(['q' => ['required', 'string', 'min:2', 'max:200']]);
        $query = trim($validated['q']);
        $normalizedQuery = OnlineLezenController::removeDiacritics(mb_strtolower($query));
        $queryLength = mb_strlen($query);
        $results = [];

        $books = Product::query()
            ->where('book_content_published', true)
            ->whereHas('bookPages')
            ->orderBy('title')
            ->orderBy('id')
            ->get(['id', 'title', 'slug']);

        foreach ($books as $book) {
            if (count($results) >= self::MAX_TOTAL) {
                break;
            }
            $bookCount = 0;
            $pages = $book->bookPages()->orderBy('page_number')->get(['page_number', 'content']);

            foreach ($pages as $page) {
                if ($bookCount >= self::MAX_PER_BOOK || count($results) >= self::MAX_TOTAL) {
                    break;
                }
                $content = preg_replace('/<[^>]*class="[^"]*page-number[^"]*"[^>]*>.*?<\/[^>]+>/is', '', (string) $page->content);
                $content = preg_replace('/<button[^>]*>.*?<\/button>/is', '', $content);
                $plain = html_entity_decode(strip_tags($content), ENT_QUOTES | ENT_HTML5, 'UTF-8');
                $plain = preg_replace('/\s+/', ' ', trim($plain));
                $pos = mb_strpos(OnlineLezenController::removeDiacritics(mb_strtolower($plain)), $normalizedQuery);
                if ($pos === false) {
                    continue;
                }

                $start = max(0, $pos - 70);
                $end = min(mb_strlen($plain), $pos + $queryLength + 70);
                $results[] = [
                    'slug' => $book->slug,
                    'title' => $book->title,
                    'page' => $page->page_number,
                    'snippet' => ($start > 0 ? '…' : '')
                        .mb_substr($plain, $start, $pos - $start)
                        .'[[HIT]]'.mb_substr($plain, $pos, $queryLength).'[[/HIT]]'
                        .mb_substr($plain, $pos + $queryLength, $end - $pos - $queryLength)
                        .($end < mb_strlen($plain) ? '…' : ''),
                ];
                $bookCount++;
            }
        }

        return response()->json([
            'results' => $results,
            'total' => count($results),
        ]);
    }
}
