<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class GoogleMerchantFeedController extends Controller
{
    public function index(): Response
    {
        $products = Product::with('category')
            ->where('is_published', true)
            ->whereNull('deleted_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $xml = $this->buildFeed($products);

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8')
            ->header('Cache-Control', 'public, max-age=3600');
    }

    private function buildFeed($products): string
    {
        $shopName = config('app.name', 'Lucide Inkt');
        $shopUrl  = config('app.url');
        $feedUrl  = route('google-merchant-feed');
        $updated  = now()->toRfc7231String();

        $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">' . PHP_EOL;
        $xml .= '  <channel>' . PHP_EOL;
        $xml .= '    <title>' . $this->escape($shopName) . '</title>' . PHP_EOL;
        $xml .= '    <link>' . $this->escape($shopUrl) . '</link>' . PHP_EOL;
        $xml .= '    <description>Google Merchant Center productfeed van ' . $this->escape($shopName) . '</description>' . PHP_EOL;
        $xml .= '    <language>nl</language>' . PHP_EOL;
        $xml .= '    <lastBuildDate>' . $updated . '</lastBuildDate>' . PHP_EOL;
        $xml .= '    <atom:link xmlns:atom="http://www.w3.org/2005/Atom" href="' . $this->escape($feedUrl) . '" rel="self" type="application/rss+xml"/>' . PHP_EOL;
        $xml .= PHP_EOL;

        foreach ($products as $product) {
            $xml .= $this->buildItem($product);
        }

        $xml .= '  </channel>' . PHP_EOL;
        $xml .= '</rss>';

        return $xml;
    }

    private function buildItem(Product $product): string
    {
        $productUrl  = route('productShow', $product->slug);
        $imageUrl    = $this->resolveImageUrl($product->image_1);
        $price       = $product->price ? number_format((float) $product->price, 2, '.', '') . ' EUR' : null;
        $availability = ($product->stock > 0) ? 'in stock' : 'out of stock';
        $description  = $product->seo_description ?: $product->short_description ?: $product->title;
        $categoryName = $product->category ? $product->category->name : '';

        // Additional images
        $additionalImages = [];
        for ($i = 2; $i <= 4; $i++) {
            $imgField = 'image_' . $i;
            $url = $this->resolveImageUrl($product->$imgField);
            if ($url) {
                $additionalImages[] = $url;
            }
        }

        $xml  = '    <item>' . PHP_EOL;
        $xml .= '      <g:id>' . $this->escape((string) ($product->ean_code ?: $product->id)) . '</g:id>' . PHP_EOL;
        $xml .= '      <g:title>' . $this->escape($product->title) . '</g:title>' . PHP_EOL;
        $xml .= '      <g:description>' . $this->escape($description) . '</g:description>' . PHP_EOL;
        $xml .= '      <g:link>' . $this->escape($productUrl) . '</g:link>' . PHP_EOL;

        if ($imageUrl) {
            $xml .= '      <g:image_link>' . $this->escape($imageUrl) . '</g:image_link>' . PHP_EOL;
        }

        foreach ($additionalImages as $additionalImage) {
            $xml .= '      <g:additional_image_link>' . $this->escape($additionalImage) . '</g:additional_image_link>' . PHP_EOL;
        }

        $xml .= '      <g:availability>' . $availability . '</g:availability>' . PHP_EOL;
        $xml .= '      <g:condition>new</g:condition>' . PHP_EOL;

        if ($price) {
            $xml .= '      <g:price>' . $this->escape($price) . '</g:price>' . PHP_EOL;
        }

        $xml .= '      <g:brand>Lucide Inkt</g:brand>' . PHP_EOL;

        if ($product->ean_code) {
            $xml .= '      <g:gtin>' . $this->escape($product->ean_code) . '</g:gtin>' . PHP_EOL;
            $xml .= '      <g:mpn>' . $this->escape($product->ean_code) . '</g:mpn>' . PHP_EOL;
        } else {
            // No GTIN available - tell Google so it doesn't reject the item
            $xml .= '      <g:identifier_exists>no</g:identifier_exists>' . PHP_EOL;
        }

        if ($categoryName) {
            $xml .= '      <g:product_type>' . $this->escape($categoryName) . '</g:product_type>' . PHP_EOL;
        }

        // Boeken vallen onder Google's productcategorie 'Media > Books'
        $xml .= '      <g:google_product_category>Media &gt; Books</g:google_product_category>' . PHP_EOL;

        if ($product->weight) {
            // weight is assumed to be stored in grams; Google expects kg
            $weightKg = round($product->weight / 1000, 3);
            $xml .= '      <g:shipping_weight>' . $weightKg . ' kg</g:shipping_weight>' . PHP_EOL;
        }

        if ($product->binding_type) {
            $xml .= '      <g:material>' . $this->escape($product->binding_type) . '</g:material>' . PHP_EOL;
        }

        if ($product->pages) {
            $xml .= '      <g:custom_label_0>' . (int) $product->pages . ' paginas</g:custom_label_0>' . PHP_EOL;
        }

        $xml .= '      <g:item_group_id>' . $this->escape($product->base_slug ?: $product->slug) . '</g:item_group_id>' . PHP_EOL;

        $xml .= '    </item>' . PHP_EOL;

        return $xml;
    }

    private function resolveImageUrl(?string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        if (str_starts_with($image, 'image/') || str_starts_with($image, 'images/')) {
            return asset($image);
        }

        return asset('storage/' . $image);
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}

