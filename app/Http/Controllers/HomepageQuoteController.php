<?php

namespace App\Http\Controllers;

use App\Models\HomepageQuote;
use Illuminate\Http\Request;

class HomepageQuoteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        $quotes = HomepageQuote::ordered()->paginate(20)->withQueryString();

        return view('homepage-quotes.index', compact('quotes'));
    }

    public function create()
    {
        return view('homepage-quotes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'text'       => 'required|string',
            'source'     => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'sometimes|boolean',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        HomepageQuote::create($validated);

        return redirect()->route('admin.homepage-quotes.index')
            ->with('success', 'Quote succesvol aangemaakt!');
    }

    public function edit(string $id)
    {
        $quote = HomepageQuote::findOrFail($id);

        return view('homepage-quotes.edit', compact('quote'));
    }

    public function update(Request $request, string $id)
    {
        $quote = HomepageQuote::findOrFail($id);

        $validated = $request->validate([
            'text'       => 'required|string',
            'source'     => 'required|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active'  => 'sometimes|boolean',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $quote->update($validated);

        return redirect()->route('admin.homepage-quotes.edit', $quote->id)
            ->with('success', 'Quote succesvol bijgewerkt!');
    }

    public function destroy(string $id)
    {
        $quote = HomepageQuote::findOrFail($id);
        $quote->delete();

        return redirect()->route('admin.homepage-quotes.index')
            ->with('success', 'Quote succesvol verwijderd!');
    }
}

