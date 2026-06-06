#!/usr/bin/env python3
"""
Compress PDFs by rasterizing pages to JPEG images and rebuilding the PDF.
This approach handles complex PDFs with large content streams.
Target: under 5 MB per file.
"""

import fitz  # PyMuPDF
import io
import os
from PIL import Image

# Quality settings
DPI = 110            # Render resolution (lower = smaller file, 110dpi is fine for screen/reading)
JPEG_QUALITY = 62    # JPEG quality for pages

TARGET_MB = 5.0


def pdf_to_compressed_pdf(input_path, output_path, dpi=DPI, quality=JPEG_QUALITY):
    orig_size = os.path.getsize(input_path) / (1024 * 1024)
    print(f"\nProcessing: {os.path.basename(input_path)} ({orig_size:.1f} MB)")

    src = fitz.open(input_path)
    page_count = len(src)

    # Create output PDF
    out_doc = fitz.open()

    for i, page in enumerate(src):
        print(f"  Page {i+1}/{page_count}...", end="\r", flush=True)

        # Render the page to a pixmap
        mat = fitz.Matrix(dpi / 72, dpi / 72)
        pix = page.get_pixmap(matrix=mat, colorspace=fitz.csRGB, alpha=False)

        # Convert to PIL for JPEG compression
        img_data = pix.tobytes("ppm")
        pil_img = Image.open(io.BytesIO(img_data))

        jpeg_buf = io.BytesIO()
        pil_img.save(jpeg_buf, format="JPEG", quality=quality, optimize=True)
        jpeg_bytes = jpeg_buf.getvalue()

        # Get original page dimensions
        rect = page.rect
        img_page = out_doc.new_page(width=rect.width, height=rect.height)
        img_page.insert_image(rect, stream=jpeg_bytes, keep_proportion=False)

    src.close()
    out_doc.save(output_path, garbage=4, deflate=True, clean=True)
    out_doc.close()

    new_size = os.path.getsize(output_path) / (1024 * 1024)
    reduction = (1 - new_size / orig_size) * 100
    print(f"\n  Result: {orig_size:.1f} MB -> {new_size:.1f} MB ({reduction:.0f}% reduction)")
    return new_size


def process_files(paths, dpi=DPI, quality=JPEG_QUALITY):
    results = []
    for path in paths:
        if not os.path.exists(path):
            print(f"File not found: {path}")
            continue

        backup = path + ".backup"
        output = path + ".new.pdf"

        new_size = pdf_to_compressed_pdf(path, output, dpi, quality)
        orig_size = os.path.getsize(path) / (1024 * 1024)

        if new_size < orig_size:
            if not os.path.exists(backup):
                os.rename(path, backup)
            else:
                os.remove(path)
            os.rename(output, path)
            print(f"  Replaced original. Backup: {os.path.basename(backup)}")
        else:
            os.remove(output)
            print(f"  No improvement - keeping original.")
        results.append((path, orig_size, new_size))
    return results


if __name__ == "__main__":
    PDF_DIR = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs"

    targets = [
        os.path.join(PDF_DIR, "herzameling.pdf"),
        os.path.join(PDF_DIR, "regathering.pdf"),
    ]

    # These are already under 5MB from previous run; skip or re-do:
    also_do = [
        os.path.join(PDF_DIR, "broederschap.pdf"),
        os.path.join(PDF_DIR, "zieken.pdf"),
    ]

    results = process_files(targets)

    print("\n=== Summary ===")
    for path, orig, new in results:
        status = "✓ OK" if new <= 5.0 else "⚠ Still over 5 MB"
        print(f"  {os.path.basename(path)}: {orig:.1f} MB -> {new:.1f} MB  {status}")


