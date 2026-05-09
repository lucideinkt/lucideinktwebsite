from PIL import Image
import os

src = r'C:\laragon\www\lucideinktwebshop\resources\images\56_wood flooring colored texture-seamless_hr.jpg'
dst = r'C:\laragon\www\lucideinktwebshop\resources\images\56_wood flooring colored texture-seamless_hr.webp'

img = Image.open(src)
print(f'Original: {img.size}, {os.path.getsize(src)/1024:.1f} KB')

# Resize to 800x800 (seamless textures keep square ratio)
img = img.resize((800, 800), Image.LANCZOS)
img.save(dst, 'WEBP', quality=82)

size = os.path.getsize(dst)
print(f'Saved: 800x800px, {size/1024:.1f} KB ({size/1024/1024:.2f} MB)')

