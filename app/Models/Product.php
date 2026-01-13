<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Product extends Model
{
    use HasFactory, HasSEO, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'stock',
        'product_copy_id',
        'is_published',
        'short_description',
        'long_description',
        'category_id',
        'base_title',
        'base_slug',
        'weight',
        'height',
        'width',
        'depth',
        'pages',
        'binding_type',
        'ean_code',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'seo_description',
        'seo_tags',
        'seo_author',
        'seo_robots',
        'seo_canonical_url',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'seo_tags' => 'array',
    ];

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function productCopy()
    {
        return $this->belongsTo(ProductCopy::class, 'product_copy_id');
    }

    public function getDynamicSEOData(): SEOData
    {
        // Build product URL
        $url = route('productShow', $this->slug);

        // Use image_1 as the main image, convert to full URL if needed
        $image = null;
        $imageUrl = null;
        if (! empty($this->image_1)) {
            $image = $this->image_1;
            // If image is not a full URL, make it one
            if (! filter_var($image, FILTER_VALIDATE_URL)) {
                if (str_starts_with($image, 'image/') || str_starts_with($image, 'images/')) {
                    $imageUrl = asset($image);
                } else {
                    $imageUrl = asset('storage/'.$image);
                }
            } else {
                $imageUrl = $image;
            }
            $image = $imageUrl;
        }

        // Prepare additional images for Product schema
        $additionalImages = [];
        for ($i = 2; $i <= 4; $i++) {
            $imageField = 'image_'.$i;
            if (! empty($this->$imageField)) {
                $additionalImage = $this->$imageField;
                if (! filter_var($additionalImage, FILTER_VALIDATE_URL)) {
                    if (str_starts_with($additionalImage, 'image/') || str_starts_with($additionalImage, 'images/')) {
                        $additionalImages[] = asset($additionalImage);
                    } else {
                        $additionalImages[] = asset('storage/'.$additionalImage);
                    }
                } else {
                    $additionalImages[] = $additionalImage;
                }
            }
        }

        // Determine product type - use Book schema if book-specific properties exist, otherwise use Product
        $isBook = $this->pages || $this->binding_type || $this->ean_code;

        // Build JSON-LD structured data
        $schema = SchemaCollection::make()
            ->add(function (SEOData $SEOData) use ($url, $imageUrl, $additionalImages, $isBook) {
                $baseSchema = [
                    '@context' => 'https://schema.org',
                    '@type' => $isBook ? 'Book' : 'Product',
                    'name' => $this->title,
                    'description' => $this->seo_description ?: $this->short_description,
                    'image' => $imageUrl ? array_filter([$imageUrl, ...$additionalImages]) : null,
                ];

                // Add Product-specific properties
                $baseSchema['sku'] = $this->ean_code;
                $baseSchema['mpn'] = $this->ean_code;
                $baseSchema['brand'] = [
                    '@type' => 'Brand',
                    'name' => 'Lucide Inkt',
                ];

                // Add Book-specific properties if applicable
                if ($isBook) {
                    $baseSchema['isbn'] = $this->ean_code;
                    if ($this->pages) {
                        $baseSchema['numberOfPages'] = $this->pages;
                    }
                    if ($this->binding_type) {
                        $baseSchema['bookFormat'] = $this->binding_type === 'hardcover'
                            ? 'https://schema.org/Hardcover'
                            : 'https://schema.org/Paperback';
                    }
                }

                // Add offers (works for both Product and Book)
                $baseSchema['offers'] = [
                    '@type' => 'Offer',
                    'url' => $url,
                    'priceCurrency' => 'EUR',
                    'price' => $this->price ? number_format($this->price, 2, '.', '') : null,
                    'availability' => $this->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                    'priceValidUntil' => now()->addYear()->format('Y-m-d'),
                ];

                return $baseSchema;
            })
            ->addBreadcrumbs(function ($breadcrumbs, SEOData $SEOData) use ($url) {
                return $breadcrumbs
                    ->prependBreadcrumbs([
                        'Home' => route('home'),
                        'Winkel' => route('shop'),
                    ])
                    ->appendBreadcrumbs([
                        $this->title => $url,
                    ]);
            });

        return new SEOData(
            title: $this->title,
            description: $this->seo_description ?: $this->short_description,
            author: $this->seo_author,
            image: $image,
            url: $url,
            robots: $this->seo_robots,
            canonical_url: $this->seo_canonical_url,
            published_time: $this->created_at,
            modified_time: $this->updated_at,
            tags: $this->seo_tags,
            schema: $schema,
        );
    }
}
