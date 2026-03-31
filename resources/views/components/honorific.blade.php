@props([
    'type',
    'size' => '1.3em'
])

@php
$map = [
    // God epithets
    'jll'           => ['file' => 'jll.svg',           'label' => 'جل جلاله',               'w' => 160],
    'jl-wala'       => ['file' => 'jl-wala.svg',       'label' => 'جل وعلا',                 'w' => 140],
    'az-wajal'      => ['file' => 'az-wajal.svg',      'label' => 'عز وجل',                  'w' => 130],
    'sbh-wataala'   => ['file' => 'sbh-wataala.svg',   'label' => 'سبحانه وتعالى',            'w' => 230],
    'tbk-wataala'   => ['file' => 'tbk-wataala.svg',   'label' => 'تبارك وتعالى',             'w' => 230],

    // Prophet SAW
    'saw'           => ['file' => 'saw.svg',           'label' => 'صلى الله عليه وسلم',      'w' => 300],
    'saas'          => ['file' => 'saas.svg',          'label' => 'صلى الله عليه وآله وسلم', 'w' => 350],

    // Alayhi salam (short)
    'as'            => ['file' => 'as.svg',            'label' => 'عليه السلام',              'w' => 190],
    'as-huma'       => ['file' => 'as-huma.svg',       'label' => 'عليهما السلام',             'w' => 210],
    'as-hum'        => ['file' => 'as-hum.svg',        'label' => 'عليهم السلام',             'w' => 200],
    'as-ha'         => ['file' => 'as-ha.svg',         'label' => 'عليها السلام',             'w' => 200],

    // Alayhi salatu wasalam (long)
    'as-full'       => ['file' => 'as-full.svg',       'label' => 'عليه الصلاة والسلام',     'w' => 300],
    'as-huma-full'  => ['file' => 'as-huma-full.svg',  'label' => 'عليهما الصلاة والسلام',    'w' => 330],
    'as-hum-full'   => ['file' => 'as-hum-full.svg',   'label' => 'عليهم الصلاة والسلام',    'w' => 320],
    'as-ha-full'    => ['file' => 'as-ha-full.svg',    'label' => 'عليها الصلاة والسلام',    'w' => 320],

    // Radhi Allah
    'ra'            => ['file' => 'ra.svg',            'label' => 'رضي الله عنه',             'w' => 210],
    'ra-anhuma'     => ['file' => 'ra-anhuma.svg',     'label' => 'رضي الله عنهما',            'w' => 240],
    'ra-anhum'      => ['file' => 'ra-anhum.svg',      'label' => 'رضي الله عنهم',            'w' => 230],
    'ra-anha'       => ['file' => 'ra-anha.svg',       'label' => 'رضي الله عنها',            'w' => 230],
    'ra-anhun'      => ['file' => 'ra-anhun.svg',      'label' => 'رضي الله عنهن',            'w' => 230],

    // Rahimahu Allah
    'rh'            => ['file' => 'rh.svg',            'label' => 'رحمه الله تعالى',          'w' => 240],
    'rh-huma'       => ['file' => 'rh-huma.svg',       'label' => 'رحمهما الله تعالى',         'w' => 270],
    'rh-hum'        => ['file' => 'rh-hum.svg',        'label' => 'رحمهم الله تعالى',         'w' => 260],
    'rh-ha'         => ['file' => 'rh-ha.svg',         'label' => 'رحمها الله تعالى',         'w' => 260],

    // Quddisa sirruh
    'qa'            => ['file' => 'qa.svg',            'label' => 'قدس الله سره',             'w' => 210],
];
$h = $map[$type] ?? null;
@endphp

@if($h)
<img
    src="{{ asset('images/honorifics/' . $h['file']) }}"
    alt="{{ $h['label'] }}"
    aria-label="{{ $h['label'] }}"
    class="honorific-svg"
    width="{{ $h['w'] }}"
    height="52"
    style="height: {{ $size }}; width: auto; vertical-align: middle; position: relative; top: -0.05em;"
    loading="lazy"
    decoding="async"
>
@endif
