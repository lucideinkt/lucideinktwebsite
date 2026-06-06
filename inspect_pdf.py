import pikepdf
from pikepdf import Pdf, PdfImage
import os

path = "/Users/bilalvanloon/Herd/LucideInktWebshop/storage/app/public/pdfs/herzameling.pdf"

with pikepdf.open(path) as pdf:
    print(f"Pages: {len(pdf.pages)}")
    for page_num in range(min(3, len(pdf.pages))):
        page = pdf.pages[page_num]
        print(f"\nPage {page_num+1}:")
        if '/Resources' in page:
            res = page['/Resources']
            print(f"  Resource keys: {list(res.keys())}")
            if '/XObject' in res:
                xobj = res['/XObject']
                print(f"  XObjects: {list(xobj.keys())}")
                for k in list(xobj.keys())[:3]:
                    obj = xobj[k]
                    print(f"    {k}: subtype={obj.get('/Subtype')}")
                    if obj.get('/Subtype') == pikepdf.Name('/Image'):
                        print(f"      W={obj.get('/Width')}, H={obj.get('/Height')}, Filter={obj.get('/Filter')}, CS={obj.get('/ColorSpace')}")
                    elif obj.get('/Subtype') == pikepdf.Name('/Form'):
                        print(f"      Form XObject - checking nested resources")
                        if '/Resources' in obj:
                            nested = obj['/Resources']
                            if '/XObject' in nested:
                                nx = nested['/XObject']
                                print(f"        Nested XObjects: {list(nx.keys())}")
                                for nk in list(nx.keys())[:3]:
                                    nobj = nx[nk]
                                    print(f"          {nk}: subtype={nobj.get('/Subtype')}")
                                    if nobj.get('/Subtype') == pikepdf.Name('/Image'):
                                        print(f"            W={nobj.get('/Width')}, H={nobj.get('/Height')}, Filter={nobj.get('/Filter')}")

