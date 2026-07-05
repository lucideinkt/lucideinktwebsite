<x-layout :seo-data="$SEOData">
    <div class="page-normal-background">
    <main class="container page artikelen">

        <div class="artikelen-hero">
            <div class="container">
                <x-breadcrumbs :items="[
                  ['label' => 'Home', 'url' => route('home')],
                  ['label' => 'Artikelen', 'url' => route('artikelen')],
                ]" />
            </div>
        </div>

        <div class="gradient-border"></div>
        <div class="text-box-background">
            <div class="artikelen-page__text-box">

                <div class="artikelen-header">
                    <h1 class="artikelen-title">Artikelen</h1>
                    <p class="artikelen-subtitle">Lees hier artikelen over uiteenlopende geloofsonderwerpen, samengesteld uit passages van de <strong>Risale-i Nur</strong>.</p>
                </div>

                <h2 class="sr-only">Artikelen over de Risale-i Nur — Bediüzzaman Said Nursi</h2>

                <div class="artikelen-grid">
                    @forelse($artikelen as $artikel)
                        @php
                            $firstTextBlock = collect($artikel->content ?? [])
                                ->firstWhere('type', 'text');
                            $preview = $firstTextBlock
                                ? Str::limit(strip_tags($firstTextBlock['html'] ?? ''), 160)
                                : null;
                        @endphp
                        <a href="{{ route('artikelenDetail', $artikel->slug) }}" class="artikel-card">
                            @if($artikel->featured_image)
                                <div class="artikel-card__image-wrapper">
                                    @if(!$artikel->is_published && ($isAdmin ?? false))
                                        <span class="artikel-card__concept-dot" title="Concept — niet gepubliceerd"></span>
                                    @endif
                                    <img
                                        src="{{ asset('storage/' . $artikel->featured_image) }}"
                                        alt="{{ $artikel->featured_image_alt ?: $artikel->title }}"
                                        class="artikel-card__image"
                                        loading="lazy"
                                        decoding="async">
                                </div>
                            @else
                                @if(!$artikel->is_published && ($isAdmin ?? false))
                                    <div class="artikel-card__no-image-concept-wrapper">
                                        <span class="artikel-card__concept-dot" title="Concept — niet gepubliceerd"></span>
                                    </div>
                                @endif
                            @endif
                            <div class="artikel-card__content">
                                <h2 class="artikel-card__title">{{ $artikel->title }}</h2>
                                @if($preview)
                                    <p class="artikel-card__intro">{{ $preview }}</p>
                                @endif
                                <span class="artikel-card__read-more">Lees meer →</span>
                            </div>
                        </a>
                    @empty
                        <div class="artikelen-empty">
                            <i class="fa-solid fa-feather-pointed"></i>
                            <p>Binnenkort inshaa'ALLAH!</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </main>
    <div class="gradient-border"></div>
    <x-footer></x-footer>
    </div>
</x-layout>

