<?php

namespace App\Services;

use RalphJSmit\Laravel\SEO\Support\SEOData;

class SEOService
{
    /**
     * Get SEO data for a specific page
     *
     * @param string $page
     * @param array $overrides
     * @return SEOData
     */
    public static function getPageSEO(string $page, array $overrides = []): SEOData
    {
        $config = self::getPageConfig($page);

        // Merge with overrides
        $config = array_merge($config, $overrides);

        return new SEOData(
            title: $config['title'] ?? null,
            description: $config['description'] ?? null,
            url: $config['url'] ?? url()->current(),
            image: $config['image'] ?? secure_url('images/books_standing_new.webp'),
            author: $config['author'] ?? 'Lucide Inkt',
            locale: $config['locale'] ?? 'nl_NL',
            site_name: $config['site_name'] ?? 'Lucide Inkt',
            type: $config['type'] ?? 'website',
        );
    }

    /**
     * Get configuration for a specific page
     *
     * @param string $page
     * @return array
     */
    private static function getPageConfig(string $page): array
    {
        $pages = [
            'home' => [
                'title' => 'Lucide Inkt | Nederlandse en Engelse vertalingen van de Risale-i Nur',
                'description' => 'Lucide Inkt is een non-profit organisatie die zich richt op de verspreiding van geloofswaarheden die omschreven zijn in de boekenreeks van de Risale-i Nur.',
                'url' => route('home'),
                'image' => secure_url('images/books_standing_new.webp'),
                'type' => 'website',
            ],
            'saidnursi' => [
                'title' => 'Lucide Inkt | Bediüzzaman Said Nursi',
                'description' => 'Ik zal de wereld bewijzen dat de Qur\'an een spirituele Zon is Die nimmer zal doven en door niemand kan worden uitgedoofd!',
                'url' => route('saidnursi'),
                'image' => secure_url('images/said_nursi_sharp.jpg'),
                'type' => 'article',
            ],
            'risale' => [
                'title' => 'Lucide Inkt | Wat is de Risale-i Nur?',
                'description' => 'Als een ware spirituele tafsir van de Qur\'an voldoet de Risale-i Nur aan alle behoeften van deze tijd. Het enige wat van de lezer gevraagd wordt, is lezen met een aandachtige blik en een onbevooroordeeld hart.',
                'url' => route('risale'),
                'image' => secure_url('images/books-stapel.webp'),
                'type' => 'article',
            ],
            'herzameling' => [
                'title' => 'Lucide Inkt | Het Traktaat over de Herzameling',
                'description' => 'Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden in dit waardevolle werk. Met onbetwistbare redenaties maakt het helder dat de herzameling in het hiernamaals noodzakelijk is.',
                'url' => route('herzameling'),
                'image' => secure_url('images/books/herzameling/NederlandsHerzameling.webp'),
                'type' => 'article',
            ],
            'contact' => [
                'title' => 'Lucide Inkt | Contact',
                'description' => 'Neem contact op met Lucide Inkt voor vragen over de Risale-i Nur vertalingen of onze diensten.',
                'url' => route('contact'),
                'image' => secure_url('images/books_standing_new.webp'),
                'type' => 'website',
            ],
            'shop' => [
                'title' => 'Winkel | Lucide Inkt',
                'description' => 'Ontdek onze collectie van Nederlandse en Engelse vertalingen van de Risale-i Nur. Bestel eenvoudig en veilig online.',
                'url' => route('shop'),
                'image' => secure_url('images/books_standing_new.webp'),
                'type' => 'website',
            ],
            'online-lezen' => [
                'title' => 'Online Bibliotheek | Lucide Inkt',
                'description' => 'Lees onze boeken direct online. Ontdek de Risale-i Nur vertalingen digitaal, waar en wanneer je maar wilt.',
                'url' => route('onlineLezen'),
                'image' => secure_url('images/books_standing_new.webp'),
                'type' => 'website',
            ],
            'audiobooks' => [
                'title' => 'Audio Bibliotheek | Lucide Inkt',
                'description' => 'Beluister onze audioboeken. Ontdek de Risale-i Nur vertalingen in audioformaat, waar en wanneer je maar wilt.',
                'url' => route('audiobooks'),
                'image' => secure_url('images/books_standing_new.webp'),
                'type' => 'website',
            ],
        ];

        return $pages[$page] ?? [];
    }

    /**
     * Generate SEO data for a product
     *
     * @param \App\Models\Product $product
     * @param string $context 'shop'|'online-lezen'|'online-lezen-html'|'audiobooks'
     * @return SEOData
     */
    public static function getProductSEO($product, string $context = 'shop'): SEOData
    {
        $titleSuffix = match($context) {
            'online-lezen', 'online-lezen-html' => ' | Online Lezen | Lucide Inkt',
            'audiobooks'                         => ' | Audioboeken | Lucide Inkt',
            default                              => ' | Lucide Inkt',
        };

        $url = match($context) {
            'online-lezen-html' => route('onlineLezenReadHtml', $product->slug),
            'online-lezen'      => route('onlineLezenRead', $product->slug),
            'audiobooks'        => route('audiobooksListen', $product->slug),
            default             => route('productShow', $product->slug),
        };

        return new SEOData(
            title: $product->title . $titleSuffix,
            description: $product->seo_description ?: $product->short_description ?: 'Ontdek ' . $product->title . ' bij Lucide Inkt.',
            url: $url,
            image: $product->image_1 ? secure_url($product->image_1) : secure_url('images/books_standing_new.webp'),
            author: 'Lucide Inkt',
            locale: 'nl_NL',
            site_name: 'Lucide Inkt',
            type: 'article',
            published_time: $product->created_at ?? null,
            modified_time: $product->updated_at ?? null,
        );
    }
}

