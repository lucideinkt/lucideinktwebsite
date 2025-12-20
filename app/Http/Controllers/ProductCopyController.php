<?php

namespace App\Http\Controllers;

use App\Models\ProductCopy;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductCopyRequest;
use App\Http\Requests\UpdateProductCopyRequest;
use Illuminate\Validation\Rule;

class ProductCopyController extends Controller
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
        $this->authorize('viewAny', ProductCopy::class);
        $productCopies = ProductCopy::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('productcopies.index', ['productCopies' => $productCopies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', ProductCopy::class);
        return view('productcopies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCopyRequest $request)
    {
        $validated = $request->validated();

        $name = $validated['name'];

        ProductCopy::create([
            'name' => $name,
            'is_published' => $validated['is_published'],
            'created_by' => auth()->id(),
        ]);

        // Redirect to index page
        return redirect()->route('productCopyIndex')->with('success', 'Productexemplaar is succesvol toegevoegd.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productCopy = ProductCopy::findOrFail($id);
        $this->authorize('update', $productCopy);
        return view('productcopies.edit', ['productCopy' => $productCopy]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductCopyRequest $request, string $id)
    {
        $productCopy = ProductCopy::findOrFail($id);
        $validated = $request->validated();

        $name = $validated['name'];

        $productCopy->update([
            'name' => $name,
            'is_published' => $validated['is_published'],
        ]);

        return back()->with('success', 'Productexemplaar is succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCopy = ProductCopy::findOrFail($id);
        $this->authorize('delete', $productCopy);
        $productCopy->update([
            'updated_by' => auth()->id(),
            'deleted_by' => auth()->id(),
        ]);
        $productCopy->delete();
        return back()->with('success', 'Productexemplaar is succesvol verwijderd.');
    }

    public function get()
    {
        return redirect()->route('dashboard');
    }
}
