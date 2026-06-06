import pikepdf
from pikepdf import PdfImage, Name
import os

path = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs/herzameling.pdf"

errors = {}
with pikepdf.open(path) as pdf:
    for objnum in range(1, len(pdf.objects) + 1):
        try:
            obj = pdf.objects[objnum]
        except Exception:
            continue
        try:
            if obj.get("/Subtype") == Name("/Image") and hasattr(obj, "read_raw_bytes"):
                raw_len = len(obj.read_raw_bytes())
                if raw_len < 5000:
                    continue
                w = int(obj.get("/Width", 0))
                h = int(obj.get("/Height", 0))
                flt = obj.get("/Filter")
                cs = obj.get("/ColorSpace")
                bpc = obj.get("/BitsPerComponent")
                try:
                    pdfimage = PdfImage(obj)
                    pil_img = pdfimage.as_pil_image()
                    status = f"OK ({pil_img.mode} {pil_img.size})"
                except Exception as e:
                    err_key = type(e).__name__ + ": " + str(e)[:80]
                    errors[err_key] = errors.get(err_key, 0) + 1
                    status = f"FAIL: {err_key}"
                print(f"  obj {objnum}: {w}x{h} filter={flt} cs={cs} bpc={bpc} raw={raw_len//1024}KB -> {status}")
        except Exception as e:
            pass

print("\nError summary:")
for k, v in sorted(errors.items(), key=lambda x: -x[1]):
    print(f"  {v}x  {k}")

