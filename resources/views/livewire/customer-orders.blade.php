<div class="customer-orders">
    @if($orders->count() > 0)
        <div class="orders-card">
            <h2 class="orders-card-title">Recente bestellingen</h2>
            <div class="orders-list">
                <div class="orders-list-header">
                    <span class="header-col order-id">Bestelling</span>
                    <span class="header-col order-date">Datum</span>
                    <span class="header-col order-total">Totaal</span>
                    <span class="header-col order-status">Status</span>
                    <span class="header-col order-actions"></span>
                </div>
                @foreach($orders as $order)
                    <div class="order-row">
                        <div class="order-id-col">
                            <span class="mobile-label">Bestelling:</span>
                            <span class="order-id">#{{ $order->id }}</span>
                        </div>
                        <div class="order-date-col">
                            <span class="mobile-label">Datum:</span>
                            <span class="order-date">{{ $order->created_at->format('d-m-Y') }}</span>
                        </div>
                        <div class="order-price-col">
                            <span class="mobile-label">Totaal:</span>
                            <span class="order-price">€ {{ number_format($order->total, 2, ',', '.') }}</span>
                        </div>
                        <div class="order-status-col">
                            <span class="mobile-label">Status:</span>
                            <span class="order-status-badge status-{{ $order->status }}">
                                @if($order->status === 'pending')
                                    <i class="fa-solid fa-clock"></i>
                                    <span>Pre-order</span>
                                @elseif($order->status === 'shipped')
                                    <i class="fa-solid fa-truck"></i>
                                    <span>In transit</span>
                                @elseif($order->status === 'completed')
                                    <i class="fa-solid fa-check"></i>
                                    <span>Bevestigd</span>
                                @elseif($order->status === 'cancelled')
                                    <i class="fa-solid fa-times"></i>
                                    <span>Geannuleerd</span>
                                @else
                                    <span>{{ $order->status_label }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="order-actions-col">
                            <div class="order-actions">
                                <a href="{{ route('showMyOrder', $order->id) }}" class="btn-view-details">
                                    <i class="fa-solid fa-eye"></i>
                                    Bekijk details
                                </a>
                                @if($order->status === 'completed')
                                    <button type="button" class="btn-order-again" wire:click="orderAgain({{ $order->id }})" wire:loading.attr="disabled">
                                        <i class="fa-solid fa-rotate-left" wire:loading.remove wire:target="orderAgain({{ $order->id }})"></i>
                                        <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="orderAgain({{ $order->id }})"></i>
                                        <span wire:loading.remove wire:target="orderAgain({{ $order->id }})">Herhaal</span>
                                        <span wire:loading wire:target="orderAgain({{ $order->id }})">Wacht...</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($orders->hasPages() && $orders->lastPage() > 1)
            <div class="orders-pagination">
                {{ $orders->links('vendor.pagination.custom') }}
            </div>
        @endif
    @else
        <div class="orders-empty-state">
            <div class="empty-state-icon">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <h3>Geen bestellingen gevonden</h3>
            <p>Je hebt nog geen bestellingen geplaatst.</p>
            <div class="empty-state-actions">
                <a href="{{ route('shop') }}" class="btn-dashboard">
                    <i class="fa-solid fa-shopping-bag"></i>
                    Ga naar de winkel
                </a>
            </div>
        </div>
    @endif

    <style>
        /* Styles moved to user-dashboard.css */
    </style>

    <script>
        function cancelOrder(orderId) {
            if (confirm('Weet je zeker dat je deze bestelling wilt annuleren?')) {
                // TODO: Implement cancel order functionality
                console.log('Cancel order:', orderId);
            }
        }

        // Listen for order-again events
        document.addEventListener('livewire:init', () => {
            Livewire.on('order-again-success', (event) => {
                const message = event[0]?.message || event?.message || 'Producten toegevoegd aan winkelwagen!';
                showToast(message, false);
            });

            Livewire.on('order-again-warning', (event) => {
                const message = event[0]?.message || event?.message || 'Producten toegevoegd met waarschuwingen.';
                showToast(message, false);
            });

            Livewire.on('order-again-error', (event) => {
                const message = event[0]?.message || event?.message || 'Er is een fout opgetreden.';
                showToast(message, true);
            });
        });

        // Fallback for browser events
        window.addEventListener('order-again-success', (event) => {
            const message = event.detail?.message || 'Producten toegevoegd aan winkelwagen!';
            showToast(message, false);
        });

        window.addEventListener('order-again-warning', (event) => {
            const message = event.detail?.message || 'Producten toegevoegd met waarschuwingen.';
            showToast(message, false);
        });

        window.addEventListener('order-again-error', (event) => {
            const message = event.detail?.message || 'Er is een fout opgetreden.';
            showToast(message, true);
        });

        function showToast(message, isError) {
            // Use the existing toast function from app.js if available
            if (typeof window.showToast === 'function') {
                window.showToast(message, isError);
            } else {
                // Fallback alert
                alert(message);
            }
        }
    </script>
</div>
