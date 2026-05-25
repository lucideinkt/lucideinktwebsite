<x-dashboard-layout>

{{-- Alerts --}}
@if(session('success'))
<div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
    <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
    <span class="ms-2 text-sm font-medium">{{ session('success') }}</span>
    <button type="button" onclick="document.getElementById('alert-success').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
    </button>
</div>
@endif

@if(session('error'))
<div id="alert-error" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
    <svg class="shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/></svg>
    <span class="ms-2 text-sm font-medium">{{ session('error') }}</span>
    <button type="button" onclick="document.getElementById('alert-error').remove()" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700">
        <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/></svg>
    </button>
</div>
@endif

{{-- Page header --}}
<div class="flex flex-wrap items-start justify-between gap-4 mb-6">
    <div>
        <a href="{{ route('newsletter.campaigns.index') }}"
           class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white mb-1">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Terug naar overzicht
        </a>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newsletter->subject }}</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Aangemaakt op {{ $newsletter->created_at->format('d-m-Y') }} door
            {{ $newsletter->creator ? $newsletter->creator->first_name . ' ' . $newsletter->creator->last_name : 'Onbekend' }}
        </p>
    </div>

    {{-- Action buttons --}}
    <div class="flex flex-wrap items-center gap-2">
        @if($newsletter->isDraft())
            <form action="{{ route('newsletter.campaigns.send', $newsletter) }}"
                  method="POST"
                  onsubmit="return confirm('Wil je deze nieuwsbrief versturen naar {{ $subscribersCount }} abonnees? Dit kan niet worden teruggedraaid.');">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                    <i class="fa-solid fa-paper-plane"></i>
                    Verstuur naar {{ $subscribersCount }} abonnees
                </button>
            </form>
            <a href="{{ route('newsletter.campaigns.edit', $newsletter) }}"
               class="inline-flex items-center gap-2 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:focus:ring-yellow-900">
                <i class="fa-solid fa-pen-to-square"></i>
                Bewerken
            </a>
        @elseif($newsletter->status === 'failed')
            <form action="{{ route('newsletter.campaigns.resend', $newsletter) }}"
                  method="POST"
                  onsubmit="return confirm('Wil je deze nieuwsbrief opnieuw proberen te versturen?');">
                @csrf
                <button type="submit"
                    class="inline-flex items-center gap-2 text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:focus:ring-yellow-900">
                    <i class="fa-solid fa-rotate-right"></i>
                    Opnieuw Versturen
                </button>
            </form>
        @endif

        <form action="{{ route('newsletter.campaigns.duplicate', $newsletter) }}" method="POST">
            @csrf
            <button type="submit"
                class="inline-flex items-center gap-2 text-gray-700 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                <i class="fa-solid fa-copy"></i>
                Dupliceren
            </button>
        </form>

        @if($newsletter->isDraft() || in_array($newsletter->status, ['sent', 'failed']))
            <form action="{{ route('newsletter.campaigns.destroy', $newsletter) }}"
                  method="POST"
                  onsubmit="return confirm('Weet je zeker dat je deze nieuwsbrief wilt verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-900">
                    <i class="fa-solid fa-trash"></i>
                    Verwijderen
                </button>
            </form>
        @endif
    </div>
</div>

{{-- Stats --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    {{-- Status card --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
        <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0
            @if($newsletter->status === 'draft') bg-yellow-100 dark:bg-yellow-900
            @elseif($newsletter->status === 'sent') bg-green-100 dark:bg-green-900
            @elseif($newsletter->status === 'sending') bg-blue-100 dark:bg-blue-900
            @else bg-red-100 dark:bg-red-900
            @endif">
            @if($newsletter->status === 'draft')
                <i class="fa-solid fa-pencil text-yellow-600 dark:text-yellow-400"></i>
            @elseif($newsletter->status === 'sent')
                <i class="fa-solid fa-circle-check text-green-600 dark:text-green-400"></i>
            @elseif($newsletter->status === 'sending')
                <i class="fa-solid fa-spinner fa-spin text-blue-600 dark:text-blue-400"></i>
            @else
                <i class="fa-solid fa-triangle-exclamation text-red-600 dark:text-red-400"></i>
            @endif
        </div>
        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
            <p class="font-semibold text-gray-900 dark:text-white">
                @if($newsletter->status === 'draft') Concept
                @elseif($newsletter->status === 'sent') Verzonden
                @elseif($newsletter->status === 'sending') Verzenden...
                @else Mislukt
                @endif
            </p>
        </div>
    </div>

    @if($newsletter->sent_count > 0 || $newsletter->failed_count > 0)
        {{-- Sent count --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-check text-green-600 dark:text-green-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Succesvol verzonden</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newsletter->sent_count }}</p>
            </div>
        </div>

        {{-- Total recipients --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-users text-blue-600 dark:text-blue-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Totaal ontvangers</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newsletter->recipients_count }}</p>
            </div>
        </div>

        @if($newsletter->failed_count > 0)
        {{-- Failed count --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-red-100 dark:bg-red-900 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-xmark text-red-600 dark:text-red-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Mislukt</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $newsletter->failed_count }}</p>
            </div>
        </div>
        @endif
    @else
        {{-- Active subscribers --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
            <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-users text-blue-600 dark:text-blue-400"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Actieve abonnees</p>
                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $subscribersCount }}</p>
            </div>
        </div>
    @endif
</div>

{{-- Campaign details + Preview layout --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Campaign details --}}
    <div class="lg:col-span-1">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-primary-600 dark:text-primary-400"></i>
                    Campagne Details
                </h3>
            </div>
            <div class="p-5 space-y-4">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Onderwerp</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $newsletter->subject }}</p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Status</p>
                    @if($newsletter->status === 'draft')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Concept</span>
                    @elseif($newsletter->status === 'sending')
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Verzenden...</span>
                    @elseif($newsletter->status === 'sent')
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Verzonden</span>
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Mislukt</span>
                    @endif
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Gemaakt door</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $newsletter->creator ? $newsletter->creator->first_name . ' ' . $newsletter->creator->last_name : 'Onbekend' }}
                    </p>
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Aangemaakt op</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $newsletter->created_at->format('d-m-Y H:i') }}</p>
                </div>
                @if($newsletter->sent_at)
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1">Verzonden op</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $newsletter->sent_at->format('d-m-Y H:i') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Email preview --}}
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-base font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fa-solid fa-eye text-primary-600 dark:text-primary-400"></i>
                    Preview
                </h3>
                <span class="text-xs text-gray-400 dark:text-gray-500 bg-gray-100 dark:bg-gray-700 px-2 py-0.5 rounded">E-mail inhoud</span>
            </div>
            <div class="p-6 border border-dashed border-gray-200 dark:border-gray-600 m-4 rounded-lg bg-gray-50 dark:bg-gray-900 prose prose-sm max-w-none dark:prose-invert text-gray-900 dark:text-white">
                {!! $newsletter->content !!}
            </div>
        </div>
    </div>

</div>

</x-dashboard-layout>
