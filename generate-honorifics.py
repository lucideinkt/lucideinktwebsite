"""
Generates all 25 honorific SVGs with OmarNaskh font subset embedded as base64.
The subset includes all Arabic characters + ss15/liga/calt GSUB features so
the calligraphic ligature forms always render — even when used as <img> tags.
"""
import base64
import subprocess
import tempfile
import os

# ── 1. All honorific texts ──────────────────────────────────────────────────
honorifics = [
    # [filename,       width, arabic_text,                         english_label]
    ['jll',            160,  'جل جلاله',                          'Jalla Jalaluhu'],
    ['jl-wala',        140,  'جل وعلا',                           'Jalla wa Ala'],
    ['az-wajal',       130,  'عز وجل',                            'Azza wa Jall'],
    ['sbh-wataala',    230,  'سبحانه وتعالى',                     'Subhanahu wa Taala'],
    ['tbk-wataala',    230,  'تبارك وتعالى',                      'Tabaraka wa Taala'],
    ['saw',            300,  'صلى الله عليه وسلم',                'Sallallahu alayhi wasallam'],
    ['saas',           350,  'صلى الله عليه وآله وسلم',           'Sallallahu alayhi wa alihi wasallam'],
    ['as',             190,  'عليه السلام',                       'Alayhi salam'],
    ['as-huma',        210,  'عليهما السلام',                      'Alayhima salam'],
    ['as-hum',         200,  'عليهم السلام',                      'Alayhim salam'],
    ['as-ha',          200,  'عليها السلام',                      'Alayha salam'],
    ['as-full',        300,  'عليه الصلاة والسلام',               'Alayhi salatu wasalam'],
    ['as-huma-full',   330,  'عليهما الصلاة والسلام',              'Alayhima salatu wasalam'],
    ['as-hum-full',    320,  'عليهم الصلاة والسلام',              'Alayhim salatu wasalam'],
    ['as-ha-full',     320,  'عليها الصلاة والسلام',              'Alayha salatu wasalam'],
    ['ra',             210,  'رضي الله عنه',                      'Radhi Allahu anhu'],
    ['ra-anhuma',      240,  'رضي الله عنهما',                     'Radhi Allahu anhuma'],
    ['ra-anhum',       230,  'رضي الله عنهم',                     'Radhi Allahu anhum'],
    ['ra-anha',        230,  'رضي الله عنها',                     'Radhi Allahu anha'],
    ['ra-anhun',       230,  'رضي الله عنهن',                     'Radhi Allahu anhun'],
    ['rh',             240,  'رحمه الله تعالى',                   'Rahimahu Allahu taala'],
    ['rh-huma',        270,  'رحمهما الله تعالى',                  'Rahimahuma Allahu taala'],
    ['rh-hum',         260,  'رحمهم الله تعالى',                  'Rahimahum Allahu taala'],
    ['rh-ha',          260,  'رحمها الله تعالى',                  'Rahimaha Allahu taala'],
    ['qa',             210,  'قدس الله سره',                      'Quddasa Allahu sirruhu'],
]

# ── 2. Collect all unique characters from all honorifics ────────────────────
all_text = ' '.join(h[2] for h in honorifics)
unique_chars = sorted(set(all_text))
unicodes_arg = ','.join(f'U+{ord(c):04X}' for c in unique_chars if c != ' ')
print(f'Unique codepoints: {unicodes_arg}')

# ── 3. Subset the font with ALL layout features (for ligature forms) ─────────
font_src  = r'resources\fonts\OmarNaskh-Regular.ttf'
subset_path = tempfile.mktemp(suffix='.woff2')

cmd = [
    'pyftsubset', font_src,
    f'--unicodes={unicodes_arg}',
    '--layout-features=*',        # include ALL OpenType features incl. ss15
    '--output-file=' + subset_path,
    '--flavor=woff2',
]
print('Running pyftsubset...')
result = subprocess.run(cmd, capture_output=True, text=True)
if result.returncode != 0:
    print('ERROR:', result.stderr)
    exit(1)

subset_size = os.path.getsize(subset_path)
orig_size   = os.path.getsize(font_src)
print(f'Subset: {subset_size:,} bytes  (original TTF: {orig_size:,} bytes, '
      f'{100 * subset_size / orig_size:.1f}%)')

# ── 4. Base64-encode the subset ──────────────────────────────────────────────
with open(subset_path, 'rb') as f:
    b64 = base64.b64encode(f.read()).decode('ascii')
os.unlink(subset_path)

font_data_uri = f'data:font/woff2;base64,{b64}'
print(f'Base64 length: {len(b64):,} chars')

# ── 5. Generate SVGs ─────────────────────────────────────────────────────────
out_dir = r'public\images\honorifics'
os.makedirs(out_dir, exist_ok=True)

def make_svg(width, arabic, label, font_uri):
    cx = width / 2
    return f'''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {width} 52" width="{width}" height="52" role="img" aria-label="{label}" overflow="visible">
  <title>{arabic}</title>
  <style>
    @font-face {{
      font-family: 'OmarNaskhRegular';
      src: url('{font_uri}') format('woff2');
    }}
    .h {{
      font-family: 'OmarNaskhRegular', 'Traditional Arabic', 'Arabic Typesetting', serif;
      font-size: 36px;
      fill: #ca2a2a;
      font-feature-settings: "ss15";
    }}
  </style>
  <text class="h" x="{cx}" y="42" text-anchor="middle" direction="rtl" unicode-bidi="embed">{arabic}</text>
</svg>'''

for name, width, arabic, label in honorifics:
    svg = make_svg(width, arabic, label, font_data_uri)
    path = os.path.join(out_dir, f'{name}.svg')
    with open(path, 'w', encoding='utf-8') as f:
        f.write(svg)
    print(f'✓ {name}.svg  ({arabic})')

print(f'\nDone — {len(honorifics)} SVGs written to {out_dir}')

