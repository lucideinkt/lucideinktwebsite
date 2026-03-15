<x-dashboard-layout>
<main class="container page dashboard">
    <h2><i class="fa-solid fa-book-open" style="margin-right:8px;"></i>HTML Boekinhoud</h2>
    <p style="color:var(--ink-muted); margin-bottom:20px;">Beheer de HTML leesinhoud per product. Als een product HTML inhoud heeft, wordt de HTML-lezer getoond i.p.v. de PDF-viewer.</p>

    @if(session('success'))
        <div class="alert alert-success" style="position: relative;">
            {{ session('success') }}
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">&times;</button>
        </div>
    @endif

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Afbeelding</th>
                    <th>Titel</th>
                    <th>Gepubliceerd</th>
                    <th>HTML Inhoud</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td style="min-width:40px;">{{ $product->id }}</td>
                        <td class="td-img">
                            @if($product->image_1)
                                <img src="{{ e(
                                    Str::startsWith($product->image_1, 'https://')
                                        ? $product->image_1
                                        : (Str::startsWith($product->image_1, 'image/books/')
                                            ? asset($product->image_1)
                                            : (Str::startsWith($product->image_1, 'images/books/')
                                                ? asset($product->image_1)
                                                : asset('storage/' . $product->image_1)
                                            )
                                        )
                                ) }}" alt="">
                            @else
                                <span style="color:var(--ink-muted);">—</span>
                            @endif
                        </td>
                        <td style="min-width:200px;">{{ $product->title }}</td>
                        <td style="min-width:100px;">
                            @if($product->is_published)
                                <span style="color:var(--green-2); font-weight:600;">Ja</span>
                            @else
                                <span style="color:var(--ink-muted);">Nee</span>
                            @endif
                        </td>
                        <td style="min-width:130px;">
                            @if($product->book_pages_count > 0)
                                <span style="display:inline-flex; align-items:center; gap:5px; color:var(--green-2); font-weight:600;">
                                    <i class="fa-solid fa-circle-check"></i> {{ $product->book_pages_count }} pagina's
                                </span>
                            @else
                                <span style="display:inline-flex; align-items:center; gap:5px; color:var(--ink-muted);">
                                    <i class="fa-regular fa-circle"></i> Geen pagina's
                                </span>
                            @endif
                        </td>
                        <td class="table-action" style="min-width:80px;">
                            <a href="{{ route('bookContent.edit', $product->id) }}" title="Bewerken">
                                <i class="fa-regular fa-pen-to-square edit action-btn"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px; color:var(--ink-muted);">
                            Geen producten gevonden.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $products->links('vendor.pagination.custom') }}
    </div>
</main>
</x-dashboard-layout>

