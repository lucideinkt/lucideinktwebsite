<x-dashboard-layout>
    <main class="container page dashboard">
        <h2>Gebruiker #{{ $user->id }}</h2>
        @if(session('success'))
            <div class="alert alert-success" style="position: relative;">
                {{ session('success') }}
                <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
            </div>
        @endif

        <div class="user-profile-section">
            <div class="user-profile-grid">
                <div class="user-profile-card user-profile-card-full">
                    <h3>Persoonlijke gegevens</h3>
                    <form action="{{ route('userEdit', $user->id) }}" method="POST" class="user-profile-form user-profile-form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="profile-fields-grid">
                            <div class="profile-field profile-field-horizontal">
                                <span class="profile-label">Naam</span>
                                <span class="profile-value">{{ $user->first_name }} {{ $user->last_name }}</span>
                            </div>
                            <div class="profile-field profile-field-horizontal">
                                <span class="profile-label">Email</span>
                                <span class="profile-value">{{ $user->email }}</span>
                            </div>
                            <div class="profile-field profile-field-horizontal">
                                <span class="profile-label">Geregistreerd op</span>
                                <span class="profile-value">{{ $user->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="profile-field profile-field-horizontal profile-field-action">
                                <label for="user_role" class="profile-label">Rol</label>
                                @php
                                    $userRoles = [
                                        'admin' => 'Admin',
                                        'user' => 'Gebruiker',
                                    ];
                                @endphp
                                <select name="user_role" id="user_role" class="profile-select">
                                    @if (!empty($userRoles))
                                        @foreach ($userRoles as $key => $label)
                                            <option value="{{ $key }}" @if($user->role === $key) selected @endif>{{ $label }}</option>
                                        @endforeach                                
                                    @endif                          
                                </select>
                            </div>
                        </div>
                        <button class="btn profile-submit-btn" type="submit">Gebruiker bijwerken</button>
                    </form>
                </div>

                @if (!empty($customer->billing_street))
                    <div class="user-profile-card">
                        <h3>Factuuradres</h3>
                        <div class="profile-field">
                            <span class="profile-label">Straatnaam</span>
                            <span class="profile-value">{{ $customer->billing_street }}</span>
                        </div>
                        <div class="profile-field">
                            <span class="profile-label">Huisnummer</span>
                            <span class="profile-value">{{ $customer->billing_house_number }}</span>
                        </div>
                        @if($customer->billing_house_number_addition)
                        <div class="profile-field">
                            <span class="profile-label">Toevoeging</span>
                            <span class="profile-value">{{ $customer->billing_house_number_addition }}</span>
                        </div>
                        @endif
                        <div class="profile-field">
                            <span class="profile-label">Postcode</span>
                            <span class="profile-value">{{ $customer->billing_postal_code }}</span>
                        </div>
                        <div class="profile-field">
                            <span class="profile-label">Plaats</span>
                            <span class="profile-value">{{ $customer->billing_city }}</span>
                        </div>
                        <div class="profile-field">
                            <span class="profile-label">Land</span>
                            <span class="profile-value">{{ $customer->billing_country }}</span>
                        </div>
                    </div>
                    <div class="user-profile-card user-profile-card-full">
                        <h3>Bestellingen overzicht</h3>
                        <div class="order-stats">
                            <div class="order-stat-item">
                                <span class="order-stat-label">Aantal bestellingen</span>
                                <span class="order-stat-value">{{ $customer->orders->count() }}</span>
                            </div>
                            <div class="order-stat-item">
                                <span class="order-stat-label">Totaal uitgegeven</span>
                                <span class="order-stat-value">€ {{ number_format($customer->orders->sum('total'), 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="order-history-section" style="margin-top: 30px;">
            <h3 class="order-history-title">Ordergeschiedenis</h3>
            <div class="table-wrapper">
                <table class="table">
                <thead>
                    <tr>
                        <th>Bestelling</th>
                        <th>Datum</th>
                        <th>Status</th>
                        <th>Totaal</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($customer) && !empty($customer->orders) && $customer->orders->count() > 0)
                        @foreach ($customer->orders as $order)
                            <tr style="cursor: pointer;" onclick="window.location='{{ route('orderShow', $order->id) }}'">
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                <td>{{ $order->status_label }}</td>
                                <td>€ {{ number_format($order->total, 2) }}</td>
                                <td>
                                    <a href="{{ route('orderShow', $order->id) }}" class="action-btn show" onclick="event.stopPropagation()">
                                        <i class="fas fa-eye show"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="table-empty-state">Geen bestellingen gevonden.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            </div>
        </div>
    </main>
</x-dashboard-layout>
