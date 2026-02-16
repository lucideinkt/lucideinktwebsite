@props(['type' => 'success'])

@php
    $icons = [
        'success' => 'fa-circle-check',
        'error' => 'fa-circle-exclamation',
        'info' => 'fa-circle-info',
        'warning' => 'fa-triangle-exclamation',
    ];

    $icon = $icons[$type] ?? $icons['success'];
@endphp

<div class="alert alert-{{ $type }}">
    <span class="alert-icon">
        <i class="fa-solid {{ $icon }}"></i>
    </span>
    <span class="alert-text">
        {{ $slot }}
    </span>
    <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
</div>

