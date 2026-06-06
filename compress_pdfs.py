#!/usr/bin/env python3
"""
Compress PDF files by re-encoding ALL embedded images at lower quality/resolution.
Scans all indirect objects in the PDF to catch images inside Form XObjects too.
"""

import pikepdf
from pikepdf import Pdf, PdfImage, Name
from PIL import Image
import io
import os

JPEG_QUALITY = 55
MAX_DIM = 1800


def recompress_image_object(pdf, obj, quality=JPEG_QUALITY, max_dim=MAX_DIM):
    try:
        pdfimage = PdfImage(obj)
        pil_img = pdfimage.as_pil_image()
    except Exception:
        return False

    try:
        if pil_img.mode in ("RGBA", "P", "LA"):
            pil_img = pil_img.convert("RGB")
        elif pil_img.mode == "CMYK":
            pil_img = pil_img.convert("RGB")
        elif pil_img.mode not in ("RGB", "L"):
            pil_img = pil_img.convert("RGB")

        w, h = pil_img.size
        if max(w, h) > max_dim:
            scale = max_dim / max(w, h)
            pil_img = pil_img.resize((int(w * scale), int(h * scale)), Image.LANCZOS)
            w, h = pil_img.size

        out = io.BytesIO()
        pil_img.save(out, format="JPEG", quality=quality, optimize=True)
        jpeg_bytes = out.getvalue()

        cs = Name("/DeviceRGB") if pil_img.mode == "RGB" else Name("/DeviceGray")

        # Write new compressed data directly into the existing stream object
        obj.write(jpeg_bytes, filter=Name("/DCTDecode"))
        obj["/Width"] = w
        obj["/Height"] = h
        obj["/ColorSpace"] = cs
        obj["/BitsPerComponent"] = 8

        # Remove keys that are no longer valid
        for key in ["/SMask", "/Mask", "/DecodeParms", "/Decode"]:
            try:
                del obj[key]
            except Exception:
                pass

        return True
    except Exception as e:
        print(f"    [image error] {e}")
        return False


def compress_pdf(input_path, output_path, quality=JPEG_QUALITY, max_dim=MAX_DIM):
    orig_size = os.path.getsize(input_path) / (1024 * 1024)
    print(f"\nProcessing: {os.path.basename(input_path)} ({orig_size:.1f} MB)")

    replaced = 0
    skipped = 0

    with pikepdf.open(input_path) as pdf:
        for objnum in range(1, len(pdf.objects) + 1):
            try:
                obj = pdf.objects[objnum]
            except Exception:
                continue
            try:
                if (obj.get("/Subtype") == Name("/Image")
                        and hasattr(obj, "read_raw_bytes")):
                    if len(obj.read_raw_bytes()) < 5000:
                        continue
                    if recompress_image_object(pdf, obj, quality, max_dim):
                        replaced += 1
                    else:
                        skipped += 1
            except Exception:
                skipped += 1

        print(f"  Replaced {replaced} images, skipped {skipped}. Saving...")
        pdf.save(
            output_path,
            compress_streams=True,
            object_stream_mode=pikepdf.ObjectStreamMode.generate,
        )

    new_size = os.path.getsize(output_path) / (1024 * 1024)
    reduction = (1 - new_size / orig_size) * 100
    print(f"  Result: {orig_size:.1f} MB -> {new_size:.1f} MB ({reduction:.0f}% reduction)")
    return new_size


def process_files(paths, quality=JPEG_QUALITY, max_dim=MAX_DIM):
    results = []
    for path in paths:
        if not os.path.exists(path):
            print(f"File not found: {path}")
            continue

        backup = path + ".backup"
        output = path + ".new.pdf"

        new_size = compress_pdf(path, output, quality, max_dim)
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
        os.path.join(PDF_DIR, "broederschap.pdf"),
        os.path.join(PDF_DIR, "zieken.pdf"),
    ]

    results = process_files(targets)

    print("\n=== Summary ===")
    for path, orig, new in results:
        status = "✓ OK" if new <= 5.0 else "⚠ Still over 5 MB"
        print(f"  {os.path.basename(path)}: {orig:.1f} MB -> {new:.1f} MB  {status}")

