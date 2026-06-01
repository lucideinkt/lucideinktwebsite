<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $staticPages = [
            ['url' => route('home'),                  'priority' => 1.0,  'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => route('shop'),                  'priority' => 0.9,  'changefreq' => Url::CHANGE_FREQUENCY_DAILY],
            ['url' => route('risale'),                'priority' => 0.7,  'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('herzameling'),           'priority' => 0.7,  'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('saidnursi'),             'priority' => 0.7,  'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('contact'),               'priority' => 0.5,  'changefreq' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('onlineLezen'),           'priority' => 0.8,  'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => route('audiobooks'),            'priority' => 0.8,  'changefreq' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => route('algemeneVoorwaarden'),   'priority' => 0.3,  'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
            ['url' => route('privacybeleid'),         'priority' => 0.3,  'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
            ['url' => route('retourbeleid'),          'priority' => 0.3,  'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
            ['url' => route('verzendingLevering'),    'priority' => 0.3,  'changefreq' => Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['changefreq'])
            );
        }

        // Published products
        Product::where('is_published', true)
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->each(function (Product $product) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('productShow', $product->slug))
                        ->setLastModificationDate($product->updated_at)
                        ->setPriority(0.8)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                );
            });

        // Published products with online reading enabled
        Product::where('is_published', true)
            ->where('book_content_published', true)
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->each(function (Product $product) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('onlineLezenRead', $product->slug))
                        ->setLastModificationDate($product->updated_at)
                        ->setPriority(0.6)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            });

        // Products with audio
        Product::where('is_published', true)
            ->whereNotNull('audio_file')
            ->where('audio_file', '!=', '')
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->each(function (Product $product) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('audiobooksListen', $product->slug))
                        ->setLastModificationDate($product->updated_at)
                        ->setPriority(0.6)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                );
            });

        return $sitemap->toResponse(request());
    }
}

