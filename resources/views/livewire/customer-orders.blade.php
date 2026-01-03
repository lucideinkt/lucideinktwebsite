<div class="customer-orders">
    <div class="orders-header">
        <h2>Mijn Bestellingen</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="position: relative; margin-bottom: 2rem;">
            {{ session('success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    @if($orders->count() > 0)
        <div class="orders-table-container">
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-row">
                        <div class="order-id-col">
                            <span class="order-id">#{{ $order->id }}</span>
                        </div>
                        <div class="order-date-col">
                            <span class="order-date">{{ $order->created_at->format('d.m.Y') }}</span>
                        </div>
                        <div class="order-price-col">
                            <span class="order-price">€ {{ number_format($order->total, 2, ',', '.') }}</span>
                        </div>
                        <div class="order-status-col">
                            <span class="order-status-badge status-{{ $order->status }}">
                                @if($order->status === 'pending')
                                    <i class="fa-solid fa-calendar"></i>
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
                                @if($order->status === 'completed')
                                    <button type="button" class="btn-order-again" wire:click="orderAgain({{ $order->id }})" wire:loading.attr="disabled">
                                        <span wire:loading.remove wire:target="orderAgain({{ $order->id }})">
                                            Opnieuw bestellen
                                        </span>
                                        <span wire:loading wire:target="orderAgain({{ $order->id }})">
                                            <i class="fa-solid fa-spinner fa-spin"></i> Toevoegen...
                                        </span>
                                    </button>
                                @elseif($order->status === 'pending' || $order->status === 'shipped')
                                    <button type="button" class="btn-cancel-order" onclick="cancelOrder({{ $order->id }})">
                                        Annuleer bestelling
                                    </button>
                                @endif
                                <a href="{{ route('showMyOrder', $order->id) }}" class="btn-view-details">
                                    Bekijk details
                                </a>
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
        </div>
    @endif

    <style>
        .customer-orders {
            width: 100%;
        }

        .orders-header {
            margin-bottom: 2rem;
        }

        .customer-orders h2 {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--main-font-color, #620505);
            margin: 0;
        }

        .orders-table-container {
            background: var(--surface-4, #fff);
            border: 1px solid var(--border-1, #D8C7A6);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .orders-list {
            display: flex;
            flex-direction: column;
        }

        .order-row {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr 2fr;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-3, #e5e5e5);
            align-items: center;
            transition: background-color 0.2s ease;
        }

        .order-row:last-child {
            border-bottom: none;
        }

        .order-row:hover {
            background-color: var(--surface-2, #feedd0);
        }

        .order-id-col {
            display: flex;
            align-items: center;
        }

        .order-id {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--main-font-color, #620505);
        }

        .order-date-col {
            display: flex;
            align-items: center;
        }

        .order-date {
            font-size: 0.875rem;
            color: var(--main-font-color, #620505);
        }

        .order-price-col {
            display: flex;
            align-items: center;
        }

        .order-price {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--main-font-color, #620505);
        }

        .order-status-col {
            display: flex;
            align-items: center;
        }

        .order-status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .order-status-badge i {
            font-size: 0.75rem;
        }

        .order-status-badge.status-pending {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .order-status-badge.status-shipped {
            background-color: #fef3c7;
            color: #92400e;
        }

        .order-status-badge.status-completed {
            background-color: var(--success-bg, #d1e7dd);
            color: var(--success-text, #0a3622);
        }

        .order-status-badge.status-completed i {
            color: var(--success-text, #0a3622);
        }

        .order-status-badge.status-cancelled {
            background-color: var(--error-bg, #f8d7da);
            color: var(--error-text, #58151c);
        }

        .order-actions-col {
            display: flex;
            align-items: center;
        }

        .order-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .btn-order-again,
        .btn-cancel-order,
        .btn-view-details {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            white-space: nowrap;
            font-family: var(--font-regular);
        }

        .btn-order-again {
            background-color: var(--teal-1, #44605b);
            color: var(--ink-inverse, #fff);
        }

        .btn-order-again:hover {
            background-color: var(--green-2, #224039);
        }

        .btn-cancel-order {
            background-color: var(--red-1, #dc3545);
            color: var(--ink-inverse, #fff);
        }

        .btn-cancel-order:hover {
            background-color: var(--red-2, #b30000);
        }

        .btn-view-details {
            background-color: var(--surface-2, #feedd0);
            color: var(--main-font-color, #620505);
            border: 1px solid var(--border-1, #D8C7A6);
        }

        .btn-view-details:hover {
            background-color: var(--surface-1, #F6F1E3);
            border-color: var(--border-2, #d8d8d8);
        }

        .orders-pagination {
            margin-top: 2rem;
        }

        .orders-empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--surface-2, #feedd0);
            border-radius: 12px;
            border: 1px solid var(--border-1, #D8C7A6);
        }

        .empty-state-icon {
            font-size: 4rem;
            color: var(--ink-muted, #888);
            margin-bottom: 1rem;
        }

        .orders-empty-state h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--main-font-color, #620505);
            margin-bottom: 0.5rem;
        }

        .orders-empty-state p {
            color: var(--ink-muted, #888);
            font-size: 0.875rem;
        }

        @media (max-width: 1024px) {
            .order-row {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .order-actions {
                flex-wrap: wrap;
            }
        }

        @media (max-width: 768px) {

            .order-row {
                padding: 1rem;
            }

            .order-actions {
                width: 100%;
            }

            .btn-order-again,
            .btn-cancel-order,
            .btn-view-details {
                flex: 1;
                text-align: center;
            }
        }
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
