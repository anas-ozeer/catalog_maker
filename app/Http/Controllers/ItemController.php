<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Catalog;
use App\Imports\ItemsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class ItemController extends Controller
{
    public function import(Request $request, Catalog $catalog)
    {
        $request->validate([
            'import_items' => 'required|file', // Added file validation
        ]);

        try {
            Excel::import(new ItemsImport($catalog->id), $request->file('import_items'));
        } catch (ValidationException $e) {
            $error = $e->failures()[0]; // Get the first failure
            $error_message = sprintf(
                'There has been an error in row %d for the %s. %s.',
                $error->row(),
                $error->attribute(),
                $error->errors()[0]
            );

            return redirect()->back()->withErrors([
                'import_items' => $error_message,
            ]);
        }

        return redirect()->back()->with('success', 'Import successful!');
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
        $request->validate([
            'item_name' => ['required', 'min:3'],
            'item_description' => ['nullable', 'string', 'max:255'],
            'item_image' => 'nullable|image',
            'item_price' => ['required', 'decimal:0,2']
        ]);

        $attributes = [
            'name' => $request['item_name'],
            'description' => $request['item_description'],
            'price' => $request['item_price'],
            'catalog_id' => $request['catalog_id']
        ];

        $attributes§['catalog_id'] = $request['catalog_id'];

        if ($request->hasFile('item_image')) {
            $attributes['image'] = $request->file('item_image')->store("items",'public');
        }
        Item::create($attributes);

        return view('items.index', [
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
        $request->validate([
            'item_name' => ['required', 'min:3'],
            'item_description' => ['nullable', 'string', 'max:255'],
            'item_image' => 'nullable|image',
            'item_price' => ['required', 'decimal:0,2']
        ]);

        $attributes = [
            'name' => $request['item_name'],
            'description' => $request['item_description'],
            'price' => $request['item_price']
        ];

        if ($request->hasFile('item_image')) {
            $attributes['image'] = $request->file('item_image')->store("items",'public');
        }

        $item->update($attributes);

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
