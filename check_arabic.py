import re

with open('database/seeders/NatuurNederlandsPagesSeeder.php', 'r', encoding='utf-8') as f:
    content = f.read()

spans = re.findall(r'<span[^>]+honorific[^>]+>(.*?)</span>', content)
for s in spans:
    print('Text:', s)
    print('Chars:', [hex(ord(c)) for c in s])
    print()

