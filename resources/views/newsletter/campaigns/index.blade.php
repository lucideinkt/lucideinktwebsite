<x-dashboard-layout>
    <main class="container page dashboard">
        <div class="page-header">
            <h2>Nieuwsbrief Campagnes</h2>
            <div class="header-actions">
                <a href="{{ route('newsletter.campaigns.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Nieuwe Nieuwsbrief
                </a>
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

        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card stat-info">
                <div class="stat-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="stat-content">
                    <h4>Totaal Campagnes</h4>
                    <p class="stat-number">{{ $newsletters->total() }}</p>
                </div>
            </div>
            <div class="stat-card stat-warning">
                <div class="stat-icon">
                    <i class="fa-solid fa-pencil"></i>
                </div>
                <div class="stat-content">
                    <h4>Concepten</h4>
                    <p class="stat-number">{{ $newsletters->where('status', 'draft')->count() }}</p>
                </div>
            </div>
            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h4>Verzonden</h4>
                    <p class="stat-number">{{ $newsletters->where('status', 'sent')->count() }}</p>
                </div>
            </div>
        </div>

        <!-- Newsletters List -->
        @if($newsletters->count() > 0)
            <div class="table-card">
                <div class="table-header">
                    <h3>Campagnes Overzicht</h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Onderwerp</th>
                                <th>Status</th>
                                <th>Verzonden</th>
                                <th>Gemaakt door</th>
                                <th>Datum</th>
                                <th class="text-right">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newsletters as $newsletter)
                                <tr>
                                    <td class="subject-cell">
                                        <a href="{{ route('newsletter.campaigns.show', $newsletter) }}" class="subject-link">
                                            <i class="fa-solid fa-envelope"></i>
                                            {{ $newsletter->subject }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($newsletter->status === 'draft')
                                            <span class="badge badge-warning">
                                                <i class="fa-solid fa-pencil"></i> Concept
                                            </span>
                                        @elseif($newsletter->status === 'sending')
                                            <span class="badge badge-info">
                                                <i class="fa-solid fa-spinner fa-spin"></i> Verzenden...
                                            </span>
                                        @elseif($newsletter->status === 'sent')
                                            <span class="badge badge-success">
                                                <i class="fa-solid fa-check"></i> Verzonden
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fa-solid fa-exclamation-triangle"></i> Mislukt
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($newsletter->sent_count > 0 || $newsletter->failed_count > 0)
                                            <div class="progress-info">
                                                <span class="success-count">{{ $newsletter->sent_count }}</span>
                                                / {{ $newsletter->recipients_count }}
                                                @if($newsletter->failed_count > 0)
                                                    <span class="failed-count" title="Mislukt">
                                                        ({{ $newsletter->failed_count }} <i class="fa-solid fa-times"></i>)
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-user"></i>
                                        {{ $newsletter->creator ? $newsletter->creator->name : 'Onbekend' }}
                                    </td>
                                    <td>
                                        <i class="fa-solid fa-calendar"></i>
                                        {{ $newsletter->created_at->format('d-m-Y') }}
                                        <span class="text-muted">{{ $newsletter->created_at->format('H:i') }}</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="action-buttons">
                                            <a href="{{ route('newsletter.campaigns.show', $newsletter) }}"
                                               class="btn btn-sm btn-info"
                                               title="Bekijken">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            @if($newsletter->isDraft())
                                                <a href="{{ route('newsletter.campaigns.edit', $newsletter) }}"
                                                   class="btn btn-sm btn-warning"
                                                   title="Bewerken">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            @endif

                                            <form action="{{ route('newsletter.campaigns.duplicate', $newsletter) }}"
                                                  method="POST"
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-secondary"
                                                        title="Dupliceren">
                                                    <i class="fa-solid fa-copy"></i>
                                                </button>
                                            </form>

                                            @if($newsletter->isDraft() || in_array($newsletter->status, ['sent', 'failed']))
                                                <form action="{{ route('newsletter.campaigns.destroy', $newsletter) }}"
                                                      method="POST"
                                                      class="delete-form"
                                                      onsubmit="return confirm('Weet je zeker dat je deze nieuwsbrief wilt verwijderen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Verwijderen">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($newsletters->hasPages())
                    <div class="table-footer">
                        {{ $newsletters->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-envelope-open"></i>
                <h3>Nog geen nieuwsbrieven</h3>
                <p>Begin met het maken van je eerste nieuwsbrief campagne</p>
                <a href="{{ route('newsletter.campaigns.create') }}" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-plus"></i> Maak je eerste nieuwsbrief
                </a>
            </div>
        @endif
    </main>
</x-dashboard-layout>
