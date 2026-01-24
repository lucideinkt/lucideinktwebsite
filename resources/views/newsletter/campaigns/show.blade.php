<x-dashboard-layout>
    <main class="container page dashboard">
        <div class="page-header">
            <div>
                <a href="{{ route('newsletter.campaigns.index') }}" class="btn btn-secondary mb-2">
                    <i class="fa-solid fa-arrow-left"></i> Terug naar overzicht
                </a>
{{--                <h2>{{ $newsletter->subject }}</h2>--}}
            </div>
            <div class="header-actions">
                @if($newsletter->isDraft())
                    <form action="{{ route('newsletter.campaigns.send', $newsletter) }}"
                          method="POST"
                          style="display: inline;"
                          onsubmit="return confirm('Wil je deze nieuwsbrief versturen naar {{ $subscribersCount }} abonnees? Dit kan niet worden teruggedraaid.');">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-paper-plane"></i> Verstuur naar {{ $subscribersCount }} abonnees
                        </button>
                    </form>
                    <a href="{{ route('newsletter.campaigns.edit', $newsletter) }}" class="btn btn-warning">
                        <i class="fa-solid fa-edit"></i> Bewerken
                    </a>
                @elseif($newsletter->status === 'failed')
                    <form action="{{ route('newsletter.campaigns.resend', $newsletter) }}"
                          method="POST"
                          style="display: inline;"
                          onsubmit="return confirm('Wil je deze nieuwsbrief opnieuw proberen te versturen?');">
                        @csrf
                        <button type="submit" class="btn btn-warning">
                            <i class="fa-solid fa-redo"></i> Opnieuw Versturen
                        </button>
                    </form>
                @endif

                <form action="{{ route('newsletter.campaigns.duplicate', $newsletter) }}"
                      method="POST"
                      style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">
                        <i class="fa-solid fa-copy"></i> Dupliceren
                    </button>
                </form>

                @if($newsletter->isDraft() || in_array($newsletter->status, ['sent', 'failed']))
                    <form action="{{ route('newsletter.campaigns.destroy', $newsletter) }}"
                          method="POST"
                          style="display: inline;"
                          onsubmit="return confirm('Weet je zeker dat je deze nieuwsbrief wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash"></i> Verwijderen
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <!-- Campaign Stats -->
        <div class="stats-grid">
            <div class="stat-card {{ $newsletter->status === 'draft' ? 'stat-warning' : ($newsletter->status === 'sent' ? 'stat-success' : ($newsletter->status === 'sending' ? 'stat-info' : 'stat-danger')) }}">
                <div class="stat-icon">
                    @if($newsletter->status === 'draft')
                        <i class="fa-solid fa-pencil"></i>
                    @elseif($newsletter->status === 'sent')
                        <i class="fa-solid fa-check-circle"></i>
                    @elseif($newsletter->status === 'sending')
                        <i class="fa-solid fa-spinner fa-spin"></i>
                    @else
                        <i class="fa-solid fa-exclamation-triangle"></i>
                    @endif
                </div>
                <div class="stat-content">
                    <h4>Status</h4>
                    <p class="stat-text">
                        @if($newsletter->status === 'draft') Concept
                        @elseif($newsletter->status === 'sent') Verzonden
                        @elseif($newsletter->status === 'sending') Verzenden...
                        @else Mislukt
                        @endif
                    </p>
                </div>
            </div>

            @if($newsletter->sent_count > 0 || $newsletter->failed_count > 0)
                <div class="stat-card stat-success">
                    <div class="stat-icon">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Succesvol Verzonden</h4>
                        <p class="stat-number">{{ $newsletter->sent_count }}</p>
                    </div>
                </div>

                @if($newsletter->failed_count > 0)
                    <div class="stat-card stat-danger">
                        <div class="stat-icon">
                            <i class="fa-solid fa-times"></i>
                        </div>
                        <div class="stat-content">
                            <h4>Mislukt</h4>
                            <p class="stat-number">{{ $newsletter->failed_count }}</p>
                        </div>
                    </div>
                @endif

                <div class="stat-card stat-info">
                    <div class="stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h4>Totaal Ontvangers</h4>
                        <p class="stat-number">{{ $newsletter->recipients_count }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Campaign Details -->
        <div class="info-card">
            <div class="info-header">
                <h3><i class="fa-solid fa-info-circle"></i> Campagne Details</h3>
            </div>
            <div class="info-body">
                <div class="info-row">
                    <span class="info-label">Onderwerp:</span>
                    <span class="info-value">{{ $newsletter->subject }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Gemaakt door:</span>
                    <span class="info-value">{{ $newsletter->creator ? $newsletter->creator->name : 'Onbekend' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Aangemaakt op:</span>
                    <span class="info-value">{{ $newsletter->created_at->format('d-m-Y H:i') }}</span>
                </div>
                @if($newsletter->sent_at)
                    <div class="info-row">
                        <span class="info-label">Verzonden op:</span>
                        <span class="info-value">{{ $newsletter->sent_at->format('d-m-Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Preview -->
        <div class="preview-card">
            <div class="preview-header">
                <h3><i class="fa-solid fa-eye"></i> Preview</h3>
            </div>
            <div class="preview-body">
                {!! $newsletter->content !!}
            </div>
        </div>
    </main>
</x-dashboard-layout>
