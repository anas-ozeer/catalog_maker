<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Catalog;
use App\Imports\ItemsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\ValidationException;
class ItemController extends Controller
{
    public function import(Request $request, Catalog $catalog)
    {
        $request->validate([
            'import_items' => 'required',
        ]);

        Excel::import(new ItemsImport($catalog['id']), $request->file('import_items'));

        return redirect()->back();
    }
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
            'item_name' => ['required', 'min:3'],
            'item_description' => ['nullable', 'string', 'max:255'],
            'item_image' => 'nullable|image',
            'item_price' => ['required', 'decimal:0,2']
        ]);

        $attributes['catalog_id'] = $request['catalog_id'];

        if ($request->hasFile('item_image')) {
            $attributes['item_image'] = $request->file('item_image')->store("items",'public');
        }

        $data_to_save = [
            'name' => $attributes['item_name'],
            'description' => $attributes['item_description'] ?? null,
            'image' => $attributes['item_image'] ?? null,
            'price' => $attributes['item_price'],
            'catalog_id' => $attributes['catalog_id']
        ];

        Item::create($data_to_save);

        return view('catalogs.show', [
            'catalog' => Catalog::find($request['catalog_id'])
        ]);
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
            'item_name' => ['required', 'min:3'],
            'item_description' => ['nullable', 'string', 'max:255'],
            'item_image' => 'nullable|image',
            'item_price' => ['required', 'decimal:0,2']
        ]);

        if ($request->hasFile('item_image')) {
            $attributes['item_image'] = $request->file('item_image')->store("items", 'public');
        } else {
            $attributes['item_image'] = $item['image'];
        }

        $data_to_save = [
            'name' => $attributes['item_name'],
            'description' => $attributes['item_description'] ?? null,
            'image' => $attributes['item_image'] ?? null,
            'price' => $attributes['item_price']
        ];

       $item->update($data_to_save);

        return view('items.show', [
            'item' => $item
        ]);
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
