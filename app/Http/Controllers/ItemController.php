<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Catalog $catalog)
    {
        return view('items.index', [
            'catalog' => $catalog
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the fields and store them
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => 'nullable',
            'item_image' => 'nullable|image',
            'price' => ['required', 'decimal:0,2']
        ]);

        if ($request->hasFile('item_image')) {
            $attributes['item_image'] = $request['item_image']->store('items', 'public');
        }

        $attributes['catalog_id'] = $request['catalog_id'];

        Item::create($attributes);

        // return redirect()->route('catalogs.show', ['catalog' => Catalog::find($request['catalog_id'])]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validate the fields and store them
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => 'nullable',
            'item_image' => 'nullable|image',
            'price' => ['required', 'numeric', 'min:0','decimal:0,2']
        ]);


        if ($request->hasFile('item_image')) {
            $attributes['item_image'] = $request->file('item_image')->store('items', 'public');
        }


        $updated = $item->update($attributes);

        if (!$updated) {
            dd($item);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $catalog = $item->catalog;
        $item->delete();
        return view('items.index', [
            'catalog' => $catalog
        ]);
    }
}
