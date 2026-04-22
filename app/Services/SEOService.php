<?php

namespace App\Services;

use RalphJSmit\Laravel\SEO\Support\SEOData;

class SEOService
{
    /**
     * The default OG share image — solid background, no transparency, good aspect ratio.
     * Used as fallback whenever a page/product image may have a transparent background.
     */
    const DEFAULT_OG_IMAGE = 'images/books_standing_new.webp';

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
            robots: $config['robots'] ?? null,
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
            // ── Homepage: brand first ────────────────────────────────────────
            'home' => [
                'title'       => 'Risale-i Nur Vertalingen Nederlands & Engels | Lucide Inkt',
                'description' => 'Lucide Inkt is een non-profit organisatie die zich richt op de verspreiding van geloofswaarheden die omschreven zijn in de boekenreeks van de Risale-i Nur.',
                'url'         => route('home'),
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'website',
            ],

            // ── Inner pages: topic first ─────────────────────────────────────
            'saidnursi' => [
                'title'       => 'Bediüzzaman Said Nursi | Lucide Inkt',
                'description' => 'Ik zal de wereld bewijzen dat de Qur\'an een spirituele Zon is Die nimmer zal doven en door niemand kan worden uitgedoofd!',
                'url'         => route('saidnursi'),
                'image'       => secure_url('images/said_nursi_sharp.jpg'), // JPEG — no transparency
                'type'        => 'article',
            ],
            'risale' => [
                'title'       => 'Wat is de Risale-i Nur? | Lucide Inkt',
                'description' => 'Als een ware spirituele tafsir van de Qur\'an voldoet de Risale-i Nur aan alle behoeften van deze tijd. Het enige wat van de lezer gevraagd wordt, is lezen met een aandachtige blik en een onbevooroordeeld hart.',
                'url'         => route('risale'),
                'image'       => secure_url('images/books-stapel.webp'),
                'type'        => 'article',
            ],
            'herzameling' => [
                'title'       => 'Het Traktaat over de Herzameling | Lucide Inkt',
                'description' => 'Definitieve antwoorden op zulke cruciale bestaansvragen zijn te vinden in dit waardevolle werk. Met onbetwistbare redenaties maakt het helder dat de herzameling in het hiernamaals noodzakelijk is.',
                'url'         => route('herzameling'),
                // Book cover WebP may have transparency — use solid-bg fallback for sharing
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'article',
            ],
            'contact' => [
                'title'       => 'Contact | Lucide Inkt',
                'description' => 'Neem contact op met Lucide Inkt voor vragen over de Risale-i Nur vertalingen of onze diensten.',
                'url'         => route('contact'),
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'website',
            ],
            'shop' => [
                'title'       => 'Winkel | Lucide Inkt',
                'description' => 'Ontdek onze collectie van Nederlandse en Engelse vertalingen van de Risale-i Nur. Bestel eenvoudig en veilig online.',
                'url'         => route('shop'),
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'website',
            ],
            'online-lezen' => [
                'title'       => 'Online Bibliotheek | Lucide Inkt',
                'description' => 'Lees onze boeken direct online. Ontdek de Risale-i Nur vertalingen digitaal, waar en wanneer je maar wilt.',
                'url'         => route('onlineLezen'),
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'website',
            ],
            'audiobooks' => [
                'title'       => 'Audio Bibliotheek | Lucide Inkt',
                'description' => 'Beluister onze audioboeken. Ontdek de Risale-i Nur vertalingen in audioformaat, waar en wanneer je maar wilt.',
                'url'         => route('audiobooks'),
                'image'       => secure_url('images/books_standing_new.webp'),
                'type'        => 'website',
            ],

            // ── Legal / info pages ───────────────────────────────────────────
            'algemene-voorwaarden' => [
                'title'       => 'Algemene Voorwaarden | Lucide Inkt',
                'description' => 'Lees de algemene voorwaarden van Lucide Inkt voor het bestellen van boeken en andere producten.',
                'url'         => route('algemeneVoorwaarden'),
                'type'        => 'website',
            ],
            'privacybeleid' => [
                'title'       => 'Privacybeleid | Lucide Inkt',
                'description' => 'Lees ons privacybeleid en ontdek hoe Lucide Inkt omgaat met uw persoonsgegevens.',
                'url'         => route('privacybeleid'),
                'type'        => 'website',
            ],
            'retourbeleid' => [
                'title'       => 'Retourbeleid | Lucide Inkt',
                'description' => 'Lees ons retourbeleid. Ontdek hoe u producten kunt retourneren bij Lucide Inkt.',
                'url'         => route('retourbeleid'),
                'type'        => 'website',
            ],
            'verzending-levering' => [
                'title'       => 'Verzending & Levering | Lucide Inkt',
                'description' => 'Informatie over verzending en levering van bestellingen bij Lucide Inkt.',
                'url'         => route('verzendingLevering'),
                'type'        => 'website',
            ],

            // ── Transactional / auth pages (noindex) ────────────────────────
            'login' => [
                'title'       => 'Inloggen | Lucide Inkt',
                'description' => 'Log in op je Lucide Inkt account om je bestellingen te beheren.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'register' => [
                'title'       => 'Registreren | Lucide Inkt',
                'description' => 'Maak een account aan bij Lucide Inkt.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'forgot-password' => [
                'title'       => 'Wachtwoord vergeten | Lucide Inkt',
                'description' => 'Reset je wachtwoord voor je Lucide Inkt account.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'reset-password' => [
                'title'       => 'Wachtwoord instellen | Lucide Inkt',
                'description' => 'Stel een nieuw wachtwoord in voor je Lucide Inkt account.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'cart' => [
                'title'       => 'Winkelwagen | Lucide Inkt',
                'description' => 'Bekijk de producten in je winkelwagen bij Lucide Inkt.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'checkout' => [
                'title'       => 'Bestelling plaatsen | Lucide Inkt',
                'description' => 'Rond je bestelling af bij Lucide Inkt.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'checkout-success' => [
                'title'       => 'Bestelling ontvangen | Lucide Inkt',
                'description' => 'Bedankt voor je bestelling bij Lucide Inkt.',
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
        ];

        return $pages[$page] ?? [];
    }

    /**
     * Generate SEO data for a product.
     *
     * OG image strategy: WebP book covers often have transparent backgrounds which
     * look bad on social platforms (shows as white/grey). We prefer the product image
     * only when it is a JPEG (guaranteed solid background). For WebP we fall back to
     * the site-wide solid-background banner.
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

        // Use product image for OG only when it is a JPEG (solid background).
        // WebP book covers may be transparent — fall back to the solid site banner.
        $ogImage = self::resolveOgImage($product->image_1);

        return new SEOData(
            title: $product->title . $titleSuffix,
            description: $product->seo_description ?: $product->short_description ?: 'Ontdek ' . $product->title . ' bij Lucide Inkt.',
            url: $url,
            image: $ogImage,
            author: 'Lucide Inkt',
            locale: 'nl_NL',
            site_name: 'Lucide Inkt',
            type: 'article',
            published_time: $product->created_at ?? null,
            modified_time: $product->updated_at ?? null,
        );
    }

    /**
     * Resolve the best OG image path.
     *
     * Rules:
     *  - JPEG/JPG  → always safe (no transparency), use as-is.
     *  - WebP/PNG  → may be transparent; fall back to the solid default.
     *  - null/empty → use solid default.
     *
     * To use a WebP product image for OG, save a flat JPEG version alongside it
     * (e.g. image_1_og) or convert the image before upload.
     */
    public static function resolveOgImage(?string $imagePath): string
    {
        if (!$imagePath) {
            return secure_url(self::DEFAULT_OG_IMAGE);
        }

        $ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        // JPEG has no alpha channel — safe for social sharing
        if (in_array($ext, ['jpg', 'jpeg'])) {
            return secure_url($imagePath);
        }

        // WebP and PNG may be transparent — use solid fallback
        return secure_url(self::DEFAULT_OG_IMAGE);
    }
}
