<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Intervention\Image\Encoders\WebpEncoder;

class ImageCompressionService
{
    /**
     * Compress and store an uploaded image so it's <= 1 MB when possible
     *
     * @param \Illuminate\Http\UploadedFile|null $file
     * @return string|null The stored file path or null if no file was provided
     */
    public function compressAndStore($file): ?string
    {
        if (!$file) {
            return null;
        }

        // Preserve SVGs as-is (Intervention rasterizes vector images)
        $mime = $file->getMimeType();
        if ($mime === 'image/svg+xml') {
            return $file->store('product_images', 'public');
        }

        try {
            // Instantiate ImageManager (prefer imagick if available)
            if (extension_loaded('imagick')) {
                $manager = ImageManager::imagick();
            } else {
                $manager = ImageManager::gd();
            }

            // Use v3 API: read() to create image instance and orient() to fix rotation
            $image = $manager->read($file->getRealPath())->orient();
        } catch (\Exception $e) {
            // If processing fails, fallback to storing original upload
            return $file->store('product_images', 'public');
        }

        $targetMaxBytes = 1024 * 1024; // 1 MB
        $originalWidth = $image->width();
        $originalHeight = $image->height();

        $scale = 1.0;
        $quality = 90;
        $finalEncoded = null;
        $usedEncoder = 'jpg';

        // If PNG, try to preserve transparency: prefer WebP (if supported) or PNG indexed encoding
        $isPng = in_array($mime, ['image/png'], true);
        $canUseWebp = extension_loaded('imagick') || function_exists('imagewebp');

        // Progressive strategy: reduce quality first (for lossy encoders), then dimensions
        while (true) {
            $tmp = clone $image;
            $newWidth = (int) max(1, $originalWidth * $scale);
            $newHeight = (int) max(1, $originalHeight * $scale);

            $tmp->resize($newWidth, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if ($isPng) {
                // Prefer WebP for smaller size when available (WebP supports alpha)
                if ($canUseWebp) {
                    $encoded = (string) $tmp->encode(new WebpEncoder($quality));
                    $usedEncoder = 'webp';
                } else {
                    // Use indexed PNG to try to reduce size while preserving alpha
                    $encoded = (string) $tmp->encode(new PngEncoder(true, true));
                    $usedEncoder = 'png';
                }
            } else {
                // Encode as JPEG for strong compression (most uploads are photos)
                $encoded = (string) $tmp->encode(new JpegEncoder($quality));
                $usedEncoder = 'jpg';
            }

            $size = strlen($encoded);

            if ($size <= $targetMaxBytes) {
                $finalEncoded = $encoded;
                break;
            }

            if (!$isPng && $quality > 30) {
                $quality -= 5;
                continue;
            }

            if ($scale > 0.5) {
                $scale -= 0.1; // reduce dimensions by 10%
                $quality = 80; // restore quality for the new size
                continue;
            }

            // If we can't get under 1MB, accept the best effort
            $finalEncoded = $encoded;
            break;
        }

        // Save with a unique filename and correct extension
        $ext = $usedEncoder === 'webp' ? 'webp' : ($usedEncoder === 'png' ? 'png' : 'jpg');
        $filename = 'product_images/' . time() . '_' . Str::random(8) . '.' . $ext;
        Storage::disk('public')->put($filename, $finalEncoded);

        return $filename;
    }
}
