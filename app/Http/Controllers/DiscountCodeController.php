<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDiscountCodeRequest;
use App\Http\Requests\UpdateDiscountCodeRequest;

class DiscountCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', DiscountCode::class);

        $discountCodes = DiscountCode::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('discountcodes.index', ['discountCodes' => $discountCodes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', DiscountCode::class);

        return view('discountcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountCodeRequest $request)
    {
        $validated = $request->validated();

        // Ensure correct formatting for discount value
        if ($validated['discount_type'] === 'percent') {
            $validated['discount'] = (int) $validated['discount'];
        } else {
            $validated['discount'] = number_format($validated['discount'], 2, '.', '');
        }

        $discountCode = DiscountCode::create($validated);

        return redirect()->route('discountCreate')
            ->with('success', 'Kortingscode succesvol aangemaakt!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        $this->authorize('update', $discountCode);
        return view('discountcodes.edit', ['discountCode' => $discountCode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountCodeRequest $request, string $id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        $validated = $request->validated();

        if ($validated['discount_type'] === 'percent') {
            $validated['discount'] = (int) $validated['discount'];
        } else {
            $validated['discount'] = number_format($validated['discount'], 2, '.', '');
        }

        $discountCode->update($validated);

        return redirect()->route('discountEdit', $discountCode->id)
            ->with('success', 'Kortingscode succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        $this->authorize('delete', $discountCode);
        $discountCode->delete();

        return redirect()->route('discountIndex')
            ->with('success', 'Kortingscode succesvol verwijderd!');
    }

    public function get()
    {
        return redirect()->route('dashboard');
    }


}
