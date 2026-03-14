@props([
    // Each: ['label' => 'Text', 'url' => route(...)]
    'items' => [],
])

@php $count = count($items); @endphp

<nav class="bc" aria-label="Breadcrumb">
    <ol class="bc-list" itemscope itemtype="https://schema.org/BreadcrumbList">
        @foreach ($items as $i => $item)
            @php $isLast = $i === $count - 1; @endphp

            <li class="bc-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                @if(!empty($item['url']) && !$isLast)
                    <a href="{{ $item['url'] }}" class="bc-pill bc-pill--link" itemprop="item">
                        @if($i === 0)<i class="fa-solid fa-house bc-pill-icon" aria-hidden="true"></i>@endif
                        <span itemprop="name">{{ $item['label'] }}</span>
                    </a>
                @else
                    <span class="bc-pill bc-pill--current" itemprop="name" aria-current="page">
                        @if($i === 0)<i class="fa-solid fa-house bc-pill-icon" aria-hidden="true"></i>@endif
                        {{ $item['label'] }}
                    </span>
                @endif
                <meta itemprop="position" content="{{ $i + 1 }}" />
            </li>

            @if(!$isLast)
                <li class="bc-sep" aria-hidden="true">/</li>
            @endif
        @endforeach
    </ol>
</nav>
