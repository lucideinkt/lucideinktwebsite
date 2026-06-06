import pikepdf
from pikepdf import Name
import os

path = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs/herzameling.pdf.backup"

print("Analyzing all large streams in PDF...")
total_stream_bytes = 0
large_streams = []

with pikepdf.open(path) as pdf:
    print(f"Total objects: {len(pdf.objects)}")
    for objnum in range(1, len(pdf.objects) + 1):
        try:
            obj = pdf.objects[objnum]
        except Exception:
            continue
        try:
            if hasattr(obj, "read_raw_bytes"):
                raw = obj.read_raw_bytes()
                raw_len = len(raw)
                total_stream_bytes += raw_len
                if raw_len > 50000:  # > 50 KB
                    subtype = obj.get("/Subtype")
                    typ = obj.get("/Type")
                    flt = obj.get("/Filter")
                    large_streams.append((raw_len, objnum, typ, subtype, flt, obj))
        except Exception:
            pass

    large_streams.sort(reverse=True)
    print(f"\nTotal stream data: {total_stream_bytes / (1024*1024):.1f} MB")
    print(f"\nTop 20 largest streams:")
    for raw_len, objnum, typ, subtype, flt, obj in large_streams[:20]:
        extra = ""
        if subtype == Name("/Image"):
            extra = f" W={obj.get('/Width')} H={obj.get('/Height')} CS={obj.get('/ColorSpace')}"
        print(f"  obj {objnum}: {raw_len//1024} KB  type={typ} subtype={subtype} filter={flt}{extra}")

