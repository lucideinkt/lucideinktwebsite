import re

with open('database/seeders/AfwegingenNederlandsPagesSeeder.php', 'r', encoding='utf-8') as f:
    content = f.read()

before = content

# 1. style="margin: ...; max-width: 500px;" → keep only max-width + centering
content = re.sub(
    r'style="margin:[^"]*;\s*max-width:\s*500px;"',
    'style="max-width: 500px; margin-left: auto; margin-right: auto;"',
    content
)

# 2. style="margin: 0 auto;" (no max-width) → remove entirely
content = re.sub(r'\s*style="margin:\s*0\s*auto;"', '', content)

# 3. style="margin: 18px auto 0 auto;" (no max-width) → remove entirely
content = re.sub(r'\s*style="margin:\s*18px\s*auto\s*0\s*auto;"', '', content)

changed = sum(1 for a, b in zip(before.splitlines(), content.splitlines()) if a != b)
print(f"Lines changed: {changed}")

with open('database/seeders/AfwegingenNederlandsPagesSeeder.php', 'w', encoding='utf-8') as f:
    f.write(content)

print('Done.')

