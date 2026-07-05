<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page artikel-detail">

        <div class="artikel-detail-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                    ['label' => 'Home', 'url' => route('home')],
                    ['label' => 'Artikelen', 'url' => route('artikelen')],
                    ['label' => $artikel->title, 'url' => route('artikelenDetail', $artikel->slug)],
                ]" />
            </div>
        </div>

        <div class="gradient-border"></div>
        <div class="text-box-background">
            <div class="artikel-detail-page__text-box">

                @if(!$artikel->is_published && ($isAdmin ?? false))
                    <a href="{{ route('admin.artikelen.edit', $artikel->id) }}" class="artikel-detail__concept-badge" title="Concept — klik om te bewerken">
                        <i class="fa-solid fa-pen-nib"></i> Concept
                    </a>
                @endif

                <div class="artikel-detail__title-wrapper">
                    <h1 class="artikel-detail__title" style="max-width:{{ $artikel->title_max_width ? $artikel->title_max_width.'px' : '800px' }};">{{ $artikel->title }}</h1>
                </div>


                @if($artikel->featured_image && ($artikel->show_featured_image ?? true))
                    <div class="artikel-detail__featured-image">
                        <img
                            src="{{ asset('storage/' . $artikel->featured_image) }}"
                            alt="{{ $artikel->featured_image_alt ?: $artikel->title }}"
                            loading="eager"
                            decoding="async">
                    </div>
                @endif

                @if($artikel->body)
                    <div class="artikel-detail__body prose">
                        {!! $artikel->body !!}
                    </div>
                @else
                {{-- Backwards compatibility: render old content blocks --}}
                @foreach($artikel->content ?? [] as $block)
                    @if($block['type'] === 'text')
                        @php
                            $hasImg    = !empty($block['img_path']);
                            $imgAlign  = $block['img_align'] ?? 'right';
                            $imgDefs   = ['left'=>'40%','right'=>'40%','center'=>'680px','full'=>'100%'];
                            $imgRawW   = trim($block['img_width'] ?? '');
                            $imgW      = $imgRawW ?: ($imgDefs[$imgAlign] ?? '40%');
                            $wrapClass = $hasImg ? "artikel-detail__text-with-image artikel-detail__text-with-image--{$imgAlign}" : '';
                            $indentClass = ($block['indent'] ?? true) ? 'artikel-detail__text-block--indent' : '';
                        @endphp
                        <div class="artikel-detail__text-block {{ $wrapClass }} {{ $indentClass }}">
                            @if($hasImg && in_array($imgAlign, ['left','right']))
                                <figure class="artikel-detail__inline-image artikel-detail__inline-image--{{ $imgAlign }}"
                                    style="width:{{ $imgW }};">
                                    <img src="{{ asset('storage/' . $block['img_path']) }}"
                                        alt="{{ $block['img_alt'] ?? '' }}"
                                        loading="lazy" decoding="async"
                                        style="width:100%;">
                                    @if(!empty($block['img_caption']))
                                        <figcaption>{{ $block['img_caption'] }}</figcaption>
                                    @endif
                                </figure>
                            @endif

                            @if($hasImg && in_array($imgAlign, ['center','full']))
                                <figure class="artikel-detail__inline-image artikel-detail__inline-image--{{ $imgAlign }}"
                                    style="{{ $imgAlign === 'full' ? 'width:100%;' : "max-width:{$imgW};" }}">
                                    <img src="{{ asset('storage/' . $block['img_path']) }}"
                                        alt="{{ $block['img_alt'] ?? '' }}"
                                        loading="lazy" decoding="async"
                                        style="width:100%;">
                                    @if(!empty($block['img_caption']))
                                        <figcaption>{{ $block['img_caption'] }}</figcaption>
                                    @endif
                                </figure>
                            @endif

                            <div class="artikel-detail__text-content">
                                @php
                                    $textHtml = $block['html'];
                                    // Auto-wrap bare text in <p> so text-indent always applies
                                    if (!preg_match('/^\s*<(p|h[1-6]|blockquote|ul|ol|div|figure|table)/i', $textHtml)) {
                                        $textHtml = '<p>' . $textHtml . '</p>';
                                    }
                                @endphp
                                {!! $textHtml !!}
                            </div>
                        </div>
                        @if(!empty($block['source']))
                            <p class="artikel-detail__source">{{ $block['source'] }}</p>
                        @endif
                    @elseif($block['type'] === 'image' && !empty($block['path']))
                        @php
                            $align    = $block['align'] ?? 'center';
                            $defaults = ['left' => '40%', 'right' => '40%', 'center' => '680px', 'full' => '100%'];
                            $rawWidth = trim($block['width'] ?? '');
                            $width    = $rawWidth ?: ($defaults[$align] ?? '680px');
                            // Build inline style depending on alignment
                            if ($align === 'left' || $align === 'right') {
                                $figStyle = "max-width:{$width};";
                                $imgStyle = "width:100%;";
                            } elseif ($align === 'full') {
                                $figStyle = '';
                                $imgStyle = 'width:100%;';
                            } else {
                                // center
                                $figStyle = '';
                                $imgStyle = "max-width:{$width};";
                            }
                        @endphp
                        <figure class="artikel-detail__image-block artikel-detail__image-block--{{ $align }}"
                            @if($figStyle) style="{{ $figStyle }}" @endif>
                            <img
                                src="{{ asset('storage/' . $block['path']) }}"
                                alt="{{ $block['alt'] ?? '' }}"
                                loading="lazy"
                                decoding="async"
                                @if($imgStyle) style="{{ $imgStyle }}" @endif>
                            @if(!empty($block['caption']))
                                <figcaption>{{ $block['caption'] }}</figcaption>
                            @endif
                        </figure>
                    @endif
                @endforeach
                @endif

                <p class="artikel-detail__back-link">
                    <a href="{{ route('artikelen') }}">← Terug naar Artikelen</a>
                </p>

            </div>
        </div>
    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>

