import { writeFileSync, mkdirSync } from 'fs';
import { resolve, dirname } from 'path';
import { fileURLToPath } from 'url';

const __dirname = dirname(fileURLToPath(import.meta.url));
const outDir = resolve(__dirname, 'public/images/honorifics');
mkdirSync(outDir, { recursive: true });

const style = `
  <style>
    @font-face {
      font-family: 'OmarNaskhRegular';
      src: url('/fonts/OmarNaskh-Regular.woff2') format('woff2'),
           url('/fonts/OmarNaskh-Regular.woff') format('woff');
    }
    .h {
      font-family: 'OmarNaskhRegular', 'Traditional Arabic', 'Arabic Typesetting', serif;
      font-size: 36px;
      fill: #ca2a2a;
      font-feature-settings: "ss15";
    }
  </style>`;

function makeSVG(width, arabic, label) {
  const cx = width / 2;
  return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ${width} 52" width="${width}" height="52" role="img" aria-label="${label}" overflow="visible">
  <title>${arabic}</title>${style}
  <text class="h" x="${cx}" y="42" text-anchor="middle" direction="rtl" unicode-bidi="embed">${arabic}</text>
</svg>`;
}

// [filename, width, arabic-text, english-label]
const honorifics = [
  // God epithets
  ['jll',           160, 'جل جلاله',                     'Jalla Jalaluhu'],
  ['jl-wala',       140, 'جل وعلا',                       'Jalla wa Ala'],
  ['az-wajal',      130, 'عز وجل',                        'Azza wa Jall'],
  ['sbh-wataala',   230, 'سبحانه وتعالى',                 'Subhanahu wa Taala'],
  ['tbk-wataala',   230, 'تبارك وتعالى',                  'Tabaraka wa Taala'],

  // Prophet SAW
  ['saw',           300, 'صلى الله عليه وسلم',            'Sallallahu alayhi wasallam'],
  ['saas',          350, 'صلى الله عليه وآله وسلم',       'Sallallahu alayhi wa alihi wasallam'],

  // Alayhi salam (short form)
  ['as',            190, 'عليه السلام',                   'Alayhi salam'],
  ['as-huma',       210, 'عليهما السلام',                  'Alayhima salam'],
  ['as-hum',        200, 'عليهم السلام',                  'Alayhim salam'],
  ['as-ha',         200, 'عليها السلام',                  'Alayha salam'],

  // Alayhi salatu wasalam (long form)
  ['as-full',       300, 'عليه الصلاة والسلام',           'Alayhi salatu wasalam'],
  ['as-huma-full',  330, 'عليهما الصلاة والسلام',          'Alayhima salatu wasalam'],
  ['as-hum-full',   320, 'عليهم الصلاة والسلام',          'Alayhim salatu wasalam'],
  ['as-ha-full',    320, 'عليها الصلاة والسلام',          'Alayha salatu wasalam'],

  // Radhi Allah
  ['ra',            210, 'رضي الله عنه',                  'Radhi Allahu anhu'],
  ['ra-anhuma',     240, 'رضي الله عنهما',                 'Radhi Allahu anhuma'],
  ['ra-anhum',      230, 'رضي الله عنهم',                 'Radhi Allahu anhum'],
  ['ra-anha',       230, 'رضي الله عنها',                 'Radhi Allahu anha'],
  ['ra-anhun',      230, 'رضي الله عنهن',                 'Radhi Allahu anhun'],

  // Rahimahu Allah
  ['rh',            240, 'رحمه الله تعالى',               'Rahimahu Allahu taala'],
  ['rh-huma',       270, 'رحمهما الله تعالى',              'Rahimahuma Allahu taala'],
  ['rh-hum',        260, 'رحمهم الله تعالى',              'Rahimahum Allahu taala'],
  ['rh-ha',         260, 'رحمها الله تعالى',              'Rahimaha Allahu taala'],

  // Quddisa sirruh
  ['qa',            210, 'قدس الله سره',                  'Quddasa Allahu sirruhu'],
];

for (const [name, width, arabic, label] of honorifics) {
  const svg = makeSVG(width, arabic, label);
  const file = resolve(outDir, `${name}.svg`);
  writeFileSync(file, svg, 'utf8');
  console.log(`✓ ${name}.svg  (${arabic})`);
}

console.log(`\nDone — ${honorifics.length} SVGs written to public/images/honorifics/`);

