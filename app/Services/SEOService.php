<?php

namespace App\Services;

use App\Models\PageSeoSetting;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class SEOService
{
    /**
     * The default OG share image — used for non-product pages (home, contact, auth, info,
     * cart, checkout, …) as well as any fallback case where a product image is not JPEG.
     */
    const DEFAULT_OG_IMAGE = 'images/social_share_logo.jpg';

    /**
     * Product/content fallback image — used when a product has no JPEG cover.
     * Kept as a solid-background book image so product pages still look great.
     */
    const PRODUCT_FALLBACK_IMAGE = 'images/books_standing_new.webp';

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

        // Check database for overrides (DB values take precedence over hardcoded config)
        try {
            $dbSetting = PageSeoSetting::where('page_key', $page)->first();
            if ($dbSetting) {
                if ($dbSetting->title)        $config['title']        = $dbSetting->title;
                if ($dbSetting->description)  $config['description']  = $dbSetting->description;
                if ($dbSetting->author)       $config['author']       = $dbSetting->author;
                if ($dbSetting->robots)       $config['robots']       = $dbSetting->robots;
                if ($dbSetting->canonical_url) $config['url']         = $dbSetting->canonical_url;
                if ($dbSetting->og_image) {
                    // Use Storage::url() so it works correctly on Cloudways and S3/CDN setups.
                    // Uploaded files live on the public disk (seo/og/…); other paths are
                    // already under public/ and need no storage prefix.
                    $config['image'] = str_starts_with($dbSetting->og_image, 'seo/og/')
                        ? Storage::disk('public')->url($dbSetting->og_image)
                        : secure_url($dbSetting->og_image);
                }
                if ($dbSetting->type)         $config['type']         = $dbSetting->type;
            }
        } catch (\Exception $e) {
            // If DB is not available during migrations, fall back to hardcoded config
        }

        // Merge with overrides
        $config = array_merge($config, $overrides);

        return new SEOData(
            title: $config['title'] ?? null,
            description: $config['description'] ?? null,
            url: $config['url'] ?? url()->current(),
            image: $config['image'] ?? secure_url(self::DEFAULT_OG_IMAGE),
            author: $config['author'] ?? 'Lucide Inkt',
            locale: $config['locale'] ?? 'nl_NL',
            site_name: $config['site_name'] ?? 'Lucide Inkt',
            type: $config['type'] ?? 'website',
            robots: $config['robots'] ?? null,
            schema: self::buildPageSchema($page, $config),
        );
    }

    /**
     * Build Schema.org structured data for static pages.
     */
    private static function buildPageSchema(string $page, array $config): ?SchemaCollection
    {
        $pageUrl  = $config['url'] ?? url()->current();
        $imageUrl = $config['image'] ?? secure_url(self::DEFAULT_OG_IMAGE);

        return match ($page) {
            'home' => SchemaCollection::make()
                ->add(fn (SEOData $d) => [
                    '@context' => 'https://schema.org',
                    '@type'    => 'Organization',
                    'name'     => 'Lucide Inkt',
                    'url'      => route('home'),
                    'logo'     => secure_url('images/logo_newest.webp'),
                    'sameAs'   => [],
                    'description' => $config['description'] ?? null,
                ])
                ->add(fn (SEOData $d) => [
                    '@context'        => 'https://schema.org',
                    '@type'           => 'WebSite',
                    'name'            => 'Lucide Inkt',
                    'url'             => route('home'),
                    'potentialAction' => [
                        '@type'       => 'SearchAction',
                        'target'      => [
                            '@type'       => 'EntryPoint',
                            'urlTemplate' => route('shop') . '?search={search_term_string}',
                        ],
                        'query-input' => 'required name=search_term_string',
                    ],
                ]),

            'shop' => SchemaCollection::make()
                ->add(fn (SEOData $d) => [
                    '@context'   => 'https://schema.org',
                    '@type'      => 'CollectionPage',
                    'name'       => $config['title'] ?? 'Winkel | Lucide Inkt',
                    'description'=> $config['description'] ?? null,
                    'url'        => $pageUrl,
                    'image'      => $imageUrl,
                    'isPartOf'   => [
                        '@type' => 'WebSite',
                        'name'  => 'Lucide Inkt',
                        'url'   => route('home'),
                    ],
                ]),

            'contact' => SchemaCollection::make()
                ->add(fn (SEOData $d) => [
                    '@context' => 'https://schema.org',
                    '@type'    => 'ContactPage',
                    'name'     => $config['title'] ?? 'Contact | Lucide Inkt',
                    'url'      => $pageUrl,
                    'isPartOf' => [
                        '@type' => 'WebSite',
                        'name'  => 'Lucide Inkt',
                        'url'   => route('home'),
                    ],
                ]),

            'saidnursi', 'risale', 'herzameling' => SchemaCollection::make()
                ->add(fn (SEOData $d) => [
                    '@context'         => 'https://schema.org',
                    '@type'            => 'Article',
                    'headline'         => $config['title'] ?? null,
                    'description'      => $config['description'] ?? null,
                    'url'              => $pageUrl,
                    'image'            => $imageUrl,
                    'publisher'        => [
                        '@type' => 'Organization',
                        'name'  => 'Lucide Inkt',
                        'logo'  => [
                            '@type' => 'ImageObject',
                            'url'   => secure_url('images/logo_newest.webp'),
                        ],
                    ],
                    'isPartOf' => [
                        '@type' => 'WebSite',
                        'name'  => 'Lucide Inkt',
                        'url'   => route('home'),
                    ],
                ]),

            default => null,
        };
    }

    /**
     * Get configuration for a specific page
     *
     * @param string $page
     * @return array
     */
    /**
     * Public accessor for page config defaults (used by dashboard).
     */
    public static function getPageConfigPublic(string $page): array
    {
        return self::getPageConfig($page);
    }

    private static function getPageConfig(string $page): array
    {
        $pages = [
            // ── Homepage: brand first ────────────────────────────────────────
            'home' => [
                'title'       => 'Risale-i Nur Vertalingen Nederlands & Engels | Lucide Inkt',
                'description' => 'Lucide Inkt is een non-profit organisatie die zich richt op de verspreiding van geloofswaarheden die omschreven zijn in de boekenreeks van de Risale-i Nur.',
                'url'         => route('home'),
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],

            // ── Inner pages: topic first ─────────────────────────────────────
            'saidnursi' => [
                'title'       => 'Said Nursi – Wie is Bediüzzaman Said Nursi? | Lucide Inkt',
                'description' => 'Said Nursi (1878–1960), bekend als Bediüzzaman, wijdde zijn leven aan de dienst van de Qur\'an en schreef de Risale-i Nur. Ontdek zijn leven en erfenis.',
                'url'         => route('saidnursi'),
                'image'       => secure_url('images/said_nursi_social.jpg'),
                'type'        => 'article',
            ],
            'risale' => [
                'title'       => 'Risale-i Nur: Spirituele Qur\'an Tafsir | Lucide Inkt',
                'description' => 'De Risale-i Nur is een spirituele Qur\'an tafsir die geloofswaarheden met rationele argumenten uiteenzet. Ontdek waarom deze tafsir uniek is voor onze tijd.',
                'url'         => route('risale'),
                'image'       => secure_url('images/stapel_new_social.jpg'),
                'type'        => 'article',
            ],
            'herzameling' => [
                'title'       => 'Bestaat er Leven na de Dood? — Risale-i Nur | Lucide Inkt',
                'description' => 'Bestaat er leven na de dood? De Risale-i Nur bewijst met rationele argumenten dat het hiernamaals noodzakelijk is — ontdek het Traktaat over de Herzameling.',
                'url'         => route('herzameling'),
                'image'       => secure_url('images/herzameling_social.jpg'),
                'type'        => 'article',
            ],
            'contact' => [
                'title'       => 'Contact | Lucide Inkt',
                'description' => 'Neem contact op met Lucide Inkt voor vragen over de Risale-i Nur vertalingen of onze diensten.',
                'url'         => route('contact'),
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],
            'shop' => [
                'title'       => 'Winkel | Lucide Inkt',
                'description' => 'Ontdek onze collectie van Nederlandse en Engelse vertalingen van de Risale-i Nur. Bestel eenvoudig en veilig online.',
                'url'         => route('shop'),
                'image'       => secure_url('images/new_books_standing.jpg'),
                'type'        => 'website',
            ],
            'online-lezen' => [
                'title'       => 'Online Bibliotheek | Lucide Inkt',
                'description' => 'Lees onze boeken direct online. Ontdek de Risale-i Nur vertalingen digitaal, waar en wanneer je maar wilt.',
                'url'         => route('onlineLezen'),
                'image'       => secure_url('images/bookshelf_social.jpg'),
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
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],
            'privacybeleid' => [
                'title'       => 'Privacybeleid | Lucide Inkt',
                'description' => 'Lees ons privacybeleid en ontdek hoe Lucide Inkt omgaat met uw persoonsgegevens.',
                'url'         => route('privacybeleid'),
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],
            'retourbeleid' => [
                'title'       => 'Retourbeleid | Lucide Inkt',
                'description' => 'Lees ons retourbeleid. Ontdek hoe u producten kunt retourneren bij Lucide Inkt.',
                'url'         => route('retourbeleid'),
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],
            'verzending-levering' => [
                'title'       => 'Verzending & Levering | Lucide Inkt',
                'description' => 'Informatie over verzending en levering van bestellingen bij Lucide Inkt.',
                'url'         => route('verzendingLevering'),
                'image'       => secure_url('images/social_share_logo.jpg'),
                'type'        => 'website',
            ],

            // ── Transactional / auth pages (noindex) ────────────────────────
            'login' => [
                'title'       => 'Inloggen | Lucide Inkt',
                'description' => 'Log in op je Lucide Inkt account om je bestellingen te beheren.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'register' => [
                'title'       => 'Registreren | Lucide Inkt',
                'description' => 'Maak een account aan bij Lucide Inkt.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'forgot-password' => [
                'title'       => 'Wachtwoord vergeten | Lucide Inkt',
                'description' => 'Reset je wachtwoord voor je Lucide Inkt account.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'reset-password' => [
                'title'       => 'Wachtwoord instellen | Lucide Inkt',
                'description' => 'Stel een nieuw wachtwoord in voor je Lucide Inkt account.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'cart' => [
                'title'       => 'Winkelwagen | Lucide Inkt',
                'description' => 'Bekijk de producten in je winkelwagen bij Lucide Inkt.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'checkout' => [
                'title'       => 'Bestelling plaatsen | Lucide Inkt',
                'description' => 'Rond je bestelling af bij Lucide Inkt.',
                'image'       => secure_url('images/social_share_logo.jpg'),
                'robots'      => 'noindex, nofollow',
                'type'        => 'website',
            ],
            'checkout-success' => [
                'title'       => 'Bestelling ontvangen | Lucide Inkt',
                'description' => 'Bedankt voor je bestelling bij Lucide Inkt.',
                'image'       => secure_url('images/social_share_logo.jpg'),
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
            'online-lezen', 'online-lezen-html' => '',
            'audiobooks'                         => ' | Audioboeken | Lucide Inkt',
            default                              => ' | Lucide Inkt',
        };

        $url = match($context) {
            'online-lezen-html' => route('onlineLezenReadHtml', $product->slug),
            'online-lezen'      => route('onlineLezenRead', $product->slug),
            'audiobooks'        => route('audiobooksListen', $product->slug),
            default             => route('productShow', $product->slug),
        };

        // Use context-specific SEO fields when available, fall back to generic fields
        $isOnline = in_array($context, ['online-lezen', 'online-lezen-html']);

        $seoTitle = $isOnline
            ? ($product->seo_title_online ?: ($product->seo_title ?: $product->title))
            : ($product->seo_title ?: $product->title);

        // Strip any previously baked-in suffix so it is never doubled
        $seoTitle = preg_replace('/\s*\|.*?(Lucide Inkt|Online Lezen|Audioboeken)\s*$/i', '', trim($seoTitle));

        $seoDescription = $isOnline
            ? ($product->seo_description_online ?: ($product->seo_description ?: $product->short_description ?: 'Ontdek ' . $product->title . ' bij Lucide Inkt.'))
            : ($product->seo_description ?: $product->short_description ?: 'Ontdek ' . $product->title . ' bij Lucide Inkt.');

        $seoRobots = $isOnline
            ? ($product->seo_robots_online ?: null)   // never inherit shop robots for online library
            : ($product->seo_robots ?: null);

        $seoCanonical = $isOnline
            ? ($product->seo_canonical_url_online ?: null)
            : ($product->seo_canonical_url ?: null);

        $seoAuthor = $product->seo_author ?: 'Lucide Inkt';

        // Resolve OG image: for online-lezen prefer the dedicated online image
        $ogImageSource = ($isOnline && !empty($product->online_lezen_image))
            ? $product->online_lezen_image
            : $product->image_1;
        $ogImage = self::resolveOgImage($ogImageSource);

        return new SEOData(
            title: $seoTitle . $titleSuffix,
            description: $seoDescription,
            url: $url,
            image: $ogImage,
            author: $seoAuthor,
            locale: 'nl_NL',
            site_name: 'Lucide Inkt',
            type: 'article',
            robots: $seoRobots,
            canonical_url: $seoCanonical,
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
            return secure_url(self::PRODUCT_FALLBACK_IMAGE);
        }

        $ext = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        // JPEG has no alpha channel — safe for social sharing
        if (in_array($ext, ['jpg', 'jpeg'])) {
            return secure_url($imagePath);
        }

        // Uploaded WebP/PNG from storage are user-controlled flat images — allow them.
        // Only book cover WebP assets (images/ prefix) may be transparent — use fallback for those.
        if (in_array($ext, ['webp', 'png']) && str_starts_with($imagePath, 'products/')) {
            return secure_url('storage/' . $imagePath);
        }

        // WebP and PNG from the public images/ folder may be transparent — use solid fallback
        return secure_url(self::PRODUCT_FALLBACK_IMAGE);
    }
}
