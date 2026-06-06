#!/usr/bin/env python3
"""
Linearize PDFs for fast web view using pikepdf.
A linearized PDF allows the first page to render immediately while the rest
of the file downloads in the background (progressive loading via byte ranges).
Also removes pikepdf, os, shutil imports from fitz that are no longer needed.
"""
import pikepdf
import os
import shutil

PDF_DIR = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs"

# Target files (only the large ones that need it)
TARGETS = [
    "herzameling.pdf",
    "regathering.pdf",
    "broederschap.pdf",
    "zieken.pdf",
    "afwegingen.pdf",
    "geloofswaarheden.pdf",
    "mirakelen.pdf",
    "natuur.pdf",
    "ramadan.pdf",
]

def linearize(path):
    orig_size = os.path.getsize(path) / (1024 * 1024)
    out_path = path + ".linear.pdf"

    print(f"  {os.path.basename(path)} ({orig_size:.1f} MB)...", end="", flush=True)
    with pikepdf.open(path) as pdf:
        pdf.save(
            out_path,
            linearize=True,
            compress_streams=True,
            object_stream_mode=pikepdf.ObjectStreamMode.generate,
        )

    new_size = os.path.getsize(out_path) / (1024 * 1024)
    reduction = (1 - new_size / orig_size) * 100
    print(f" → {new_size:.1f} MB ({reduction:.0f}% smaller)")

    shutil.move(out_path, path)
    return new_size


if __name__ == "__main__":
    print("=" * 50)
    print("PDF Linearization (Fast Web View)")
    print("=" * 50)

    for name in TARGETS:
        path = os.path.join(PDF_DIR, name)
        if os.path.exists(path):
            linearize(path)
        else:
            print(f"\n  Skipping {name} — not found")

    print("\nDone. PDFs are now linearized for fast first-page loading.")




