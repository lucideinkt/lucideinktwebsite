<x-dashboard-layout>
    <main class="container page dashboard">
        <div class="page-header">
            <h2>Nieuwsbrief Abonnees</h2>
            <div class="header-actions">
                <a href="{{ route('admin.newsletter.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i> Nieuwe Abonnee
                </a>
                <a href="{{ route('admin.newsletter.export') }}" class="btn btn-primary">
                    <i class="fa-solid fa-download"></i> Exporteer CSV
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

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-content">
                    <h4>Totaal</h4>
                    <p class="stat-number">{{ $stats['total'] }}</p>
                </div>
            </div>
            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h4>Ingeschreven</h4>
                    <p class="stat-number">{{ $stats['subscribed'] }}</p>
                </div>
            </div>
            <div class="stat-card stat-danger">
                <div class="stat-icon">
                    <i class="fa-solid fa-times-circle"></i>
                </div>
                <div class="stat-content">
                    <h4>Uitgeschreven</h4>
                    <p class="stat-number">{{ $stats['unsubscribed'] }}</p>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-card">
            <form method="GET" class="filter-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="search">Zoek op email</label>
                        <input type="text" name="search" id="search" placeholder="E-mailadres..."
                               value="{{ request('search') }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Alle statussen</option>
                            <option value="subscribed" {{ request('status') === 'subscribed' ? 'selected' : '' }}>Ingeschreven</option>
                            <option value="unsubscribed" {{ request('status') === 'unsubscribed' ? 'selected' : '' }}>Uitgeschreven</option>
                        </select>
                    </div>
                    <div class="form-group form-actions">
                        <label>&nbsp;</label>
                        <div class="button-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-filter"></i> Filteren
                            </button>
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.newsletter.index') }}" class="btn btn-secondary">
                                    <i class="fa-solid fa-times"></i> Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Subscribers Table -->
        @if($subscribers->count() > 0)
            <div class="table-card">
                <div class="table-header">
                    <h3>Abonnees ({{ $subscribers->total() }})</h3>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Ingeschreven op</th>
                                <th>IP Adres</th>
                                <th class="text-right">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscribers as $subscriber)
                                <tr>
                                    <td class="email-cell">
                                        <i class="fa-solid fa-envelope"></i>
                                        {{ $subscriber->email }}
                                    </td>
                                    <td>
                                        @if($subscriber->status === 'subscribed')
                                            <span class="badge badge-success">
                                                <i class="fa-solid fa-check"></i> Ingeschreven
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fa-solid fa-times"></i> Uitgeschreven
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->subscribed_at)
                                            <i class="fa-solid fa-calendar"></i>
                                            {{ $subscriber->subscribed_at->format('d-m-Y') }}
                                            <span class="text-muted">{{ $subscriber->subscribed_at->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subscriber->ip_address)
                                            <code>{{ $subscriber->ip_address }}</code>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.newsletter.edit', $subscriber->id) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Bewerken">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.newsletter.toggle', $subscriber->id) }}"
                                                  method="POST"
                                                  class="toggle-form"
                                                  style="display: inline;">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm {{ $subscriber->isSubscribed() ? 'btn-secondary' : 'btn-success' }}"
                                                        title="{{ $subscriber->isSubscribed() ? 'Uitschrijven' : 'Inschrijven' }}">
                                                    <i class="fa-solid fa-{{ $subscriber->isSubscribed() ? 'ban' : 'check' }}"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.newsletter.destroy', $subscriber->id) }}"
                                                  method="POST"
                                                  class="delete-form"
                                                  onsubmit="return confirm('Weet je zeker dat je deze abonnee wilt verwijderen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Verwijderen">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($subscribers->hasPages())
                    <div class="table-footer">
                        {{ $subscribers->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="empty-state">
                <i class="fa-solid fa-inbox"></i>
                <h3>Geen abonnees gevonden</h3>
                <p>{{ request('search') || request('status') ? 'Probeer andere filters' : 'Er zijn nog geen nieuwsbrief abonnees' }}</p>
            </div>
        @endif
    </main>
</x-dashboard-layout>
