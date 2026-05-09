from PIL import Image
import os

src = r'C:\laragon\www\lucideinktwebshop\public\images\14_red carpeting texture-seamless_hr.jpg'
dst = r'C:\laragon\www\lucideinktwebshop\resources\images\14_red carpeting texture-seamless_hr.webp'

img = Image.open(src)
print(f'Original: {img.size}, mode: {img.mode}')

# For a seamless texture used at 1300px background-size, 1200px wide is plenty
max_w = 1200
if img.width > max_w:
    ratio = max_w / img.width
    new_size = (max_w, int(img.height * ratio))
    img = img.resize(new_size, Image.LANCZOS)
else:
    new_size = img.size

# Convert to RGB if needed
if img.mode in ('RGBA', 'P'):
    img = img.convert('RGB')

img.save(dst, 'WEBP', quality=82)
size = os.path.getsize(dst)
print(f'Saved: {dst}')
print(f'New size: {new_size[0]}x{new_size[1]}px')
print(f'File size: {size / 1024:.1f} KB ({size / 1024 / 1024:.2f} MB)')

