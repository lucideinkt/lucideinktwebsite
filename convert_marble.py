from PIL import Image
import os

src = r'C:\laragon\www\lucideinktwebshop\resources\images\42_slab marble Venice red texture_hr.jpg'
dst = r'C:\laragon\www\lucideinktwebshop\resources\images\42_slab marble Venice red texture_hr.webp'

img = Image.open(src)
print(f'Original: {img.size}, mode: {img.mode}')

max_dim = 1200
ratio = min(max_dim / img.width, max_dim / img.height)
if ratio < 1:
    new_size = (int(img.width * ratio), int(img.height * ratio))
    img = img.resize(new_size, Image.LANCZOS)
else:
    new_size = img.size

if img.mode in ('RGBA', 'P'):
    img = img.convert('RGB')

img.save(dst, 'WEBP', quality=85)
size = os.path.getsize(dst)
print(f'Saved: {dst}')
print(f'New size: {new_size[0]}x{new_size[1]}px')
print(f'File size: {size / 1024:.1f} KB ({size / 1024 / 1024:.2f} MB)')


