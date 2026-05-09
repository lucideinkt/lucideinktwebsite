from PIL import Image
import os

src = r'C:\laragon\www\lucideinktwebshop\resources\images\15_green velvet fabric texture-seamless_hr.jpg'
dst = r'C:\laragon\www\lucideinktwebshop\resources\images\15_green velvet fabric texture-seamless_hr.webp'

img = Image.open(src)
print(f'Original: {img.size}, mode: {img.mode}')

# For seamless textures keep size reasonable — max 1200px on longest side
max_dim = 1200
w, h = img.size
if max(w, h) > max_dim:
    ratio = max_dim / max(w, h)
    new_size = (int(w * ratio), int(h * ratio))
    img = img.resize(new_size, Image.LANCZOS)
else:
    new_size = (w, h)

if img.mode in ('RGBA', 'LA'):
    bg = Image.new('RGB', img.size, (255, 255, 255))
    bg.paste(img, mask=img.split()[-1])
    img = bg
elif img.mode != 'RGB':
    img = img.convert('RGB')

img.save(dst, 'WEBP', quality=85)
size = os.path.getsize(dst)
print(f'Saved: {dst}')
print(f'New size: {new_size[0]}x{new_size[1]}px')
print(f'File size: {size/1024:.1f} KB ({size/1024/1024:.2f} MB)')


