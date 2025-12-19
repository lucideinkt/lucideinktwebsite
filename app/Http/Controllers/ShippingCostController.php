<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingCost;
use App\Http\Requests\StoreShippingCostRequest;
use App\Http\Requests\UpdateShippingCostRequest;
use Illuminate\Validation\Rule;

class ShippingCostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except('getCost');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ShippingCost::class);
        $shippingCosts = ShippingCost::orderBy('created_at', 'desc')->paginate(10);
        return view('shippingcosts.index', ['shippingCosts' => $shippingCosts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', ShippingCost::class);
        return view('shippingcosts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingCostRequest $request)
    {
        $validated = $request->validated();

        $shippingCost = ShippingCost::create([
            'amount' => $validated['amount'],
            'country' => $validated['country'],
            'is_published' => $validated['is_published'],
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('shippingCostIndex')->with('success', 'Verzendkosten zijn succesvol toegevoegd.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shippingCost = ShippingCost::findOrFail($id);
        $this->authorize('update', $shippingCost);
        return view('shippingcosts.edit', ['shippingCost' => $shippingCost]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingCostRequest $request, string $id)
    {
        $shippingCost = ShippingCost::findOrFail($id);
        $validated = $request->validated();

        $shippingCost->update([
            'amount' => $validated['amount'],
            'country' => $validated['country'],
            'is_published' => $validated['is_published'],
        ]);

        return back()->with('success', 'Verzendkosten zijn succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shippingCost = ShippingCost::findOrFail($id);
        $this->authorize('delete', $shippingCost);
        $shippingCost->update([
            'updated_by' => auth()->id(),
            'deleted_by' => auth()->id(),
        ]);
        $shippingCost->delete();
        return back()->with('success', 'Verzendkosten zijn succesvol verwijderd.');
    }

    public function getCost(Request $request)
    {
        $country = $request->query('country');
        $shippingCost = \App\Models\ShippingCost::where('country', $country)
            ->where('is_published', 1)
            ->orderByDesc('amount')
            ->first();

        $cost = $shippingCost ? $shippingCost->amount : 0;
        return response()->json(['cost' => $cost]);
    }

    public function get()
    {
        return redirect()->route('dashboard');
    }
}
