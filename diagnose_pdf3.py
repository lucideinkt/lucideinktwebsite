import pikepdf
from pikepdf import Name
import os

path = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs/herzameling.pdf.backup"

with pikepdf.open(path) as pdf:
    # Look at several of the large FlateDecode objects
    for objnum in [558, 531, 8, 25, 7346, 7363]:
        try:
            obj = pdf.objects[objnum]
            raw_len = len(obj.read_raw_bytes())
            print(f"\nobj {objnum} ({raw_len//1024} KB compressed):")
            print(f"  Keys: {list(obj.keys())}")

            # Try to decompress and see the size
            try:
                decoded = obj.read_bytes()
                print(f"  Decoded size: {len(decoded)//1024} KB")
                # Check if it looks like raw pixels
                if len(decoded) > 0:
                    # Check for PDF content stream markers
                    sample = decoded[:200]
                    print(f"  First 100 bytes (hex): {sample[:100].hex()}")
                    try:
                        print(f"  First 100 chars: {sample[:100]}")
                    except:
                        print("  (binary data)")
            except Exception as e:
                print(f"  Decode error: {e}")
        except Exception as e:
            print(f"obj {objnum}: error - {e}")

