<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use RuntimeException;

class BookContentVersion
{
    /**
     * @return array{content_version: string, pages: Collection, toc: array}
     */
    public function snapshot(Product $product): array
    {
        $pages = $product->bookPages()->orderBy('page_number')->get(['page_number', 'content']);
        $toc = config('book_toc.'.$product->slug, []);
        $cover = $product->online_lezen_image ?: $product->image_1;
        $coverSource = $cover && ! filter_var($cover, FILTER_VALIDATE_URL) && ! str_starts_with($cover, 'images/')
            ? '/storage/'.$cover
            : $cover;
        $serializerHash = hash_file('sha256', __DIR__.'/BookPageJsonSerializer.php');
        if ($serializerHash === false) {
            throw new RuntimeException('Unable to read the book serializer for content versioning.');
        }
        $context = hash_init('sha256');
        hash_update($context, json_encode([
            'format' => 1,
            'serializer' => $serializerHash,
            'slug' => $product->slug,
            'title' => $product->title,
            'description' => $product->short_description,
            'cover' => $coverSource,
            'toc' => $toc,
        ], JSON_THROW_ON_ERROR));
        foreach ($pages as $page) {
            hash_update($context, json_encode([(int) $page->page_number, (string) $page->content], JSON_THROW_ON_ERROR));
        }
        $contentHash = hash_final($context);

        // Cache parsing only; file bytes are hashed again so same-path replacements are detected.
        $sources = Cache::remember('book-image-sources-v1:'.$contentHash, 3600, function () use ($pages, $coverSource): array {
            $sources = $coverSource ? [$coverSource => true] : [];
            $serializer = app(BookPageJsonSerializer::class);
            foreach ($pages as $page) {
                $data = $serializer->serialize((int) $page->page_number, (string) $page->content);
                $this->collectImages($data['blocks'], $sources);
                foreach ($data['footnotes'] as $note) {
                    $this->collectImages($note['blocks'], $sources);
                }
            }
            $sources = array_keys($sources);
            sort($sources, SORT_STRING);

            return $sources;
        });

        $assets = [];
        foreach ($sources as $source) {
            $assets[] = [$source, $this->localImageHash($source)];
        }

        return [
            'content_version' => hash('sha256', $contentHash.json_encode($assets, JSON_THROW_ON_ERROR)),
            'pages' => $pages,
            'toc' => $toc,
        ];
    }

    private function collectImages(array $nodes, array &$sources): void
    {
        foreach ($nodes as $node) {
            if (isset($node['src'])) {
                $sources[$node['src']] = true;
            }
            $this->collectImages($node['children'] ?? [], $sources);
        }
    }

    private function localImageHash(string $source): ?string
    {
        $host = parse_url($source, PHP_URL_HOST);
        if ($host && ! in_array($host, [parse_url(config('app.url'), PHP_URL_HOST), request()->getHost()], true)) {
            return null;
        }
        if (str_starts_with($source, 'data:')) {
            return null;
        }
        $path = ltrim(rawurldecode(parse_url($source, PHP_URL_PATH) ?: ''), '/');
        $root = str_starts_with($path, 'storage/') ? storage_path('app/public') : public_path();
        $relative = str_starts_with($path, 'storage/') ? substr($path, 8) : $path;
        $file = realpath($root.'/'.$relative);
        $resolvedRoot = realpath($root);
        if (! $file || ! $resolvedRoot || ! str_starts_with($file, $resolvedRoot.DIRECTORY_SEPARATOR) || ! is_file($file)) {
            return null;
        }
        $hash = hash_file('sha256', $file);
        if ($hash === false) {
            throw new RuntimeException('Unable to read a book image for content versioning.');
        }

        return $hash;
    }
}
