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
    public function delete_all(Catalog $catalog) {
        Item::where('catalog_id', $catalog['id'])->delete();
        return redirect()->back();
    }

    public function import(Request $request, Catalog $catalog)
    {
        $correct_format = false;
        $request->validate([
            'import_items' => 'required|file', // Added file validation
        ]);

        try {
            Excel::import(new ItemsImport($catalog->id), $request->file('import_items'));
        } catch (ValidationException $e) {

            $error = $e->failures()[0];
            $error_message = "";
            if (($correct_format == true) || (array_key_exists("name", $error->values()) && array_key_exists("price", $error->values()) && array_key_exists("price", $error->values()))) {
                $error_message = sprintf(
                    'There has been an error in row %d for the %s. %s.',
                    $error->row(),
                    $error->attribute(),
                    $error->errors()[0]
                );
            }
            else {
                $error_message = "There has been an error in the format. There is a missing heading! Format: name,description,price";
            }
            return redirect()->back()->withErrors([
                'import_items' => $error_message,
            ]);
        }

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
     * Bulk import image form
     */
    public function bulk_edit_image(Item $item)
    {
        return view('items.bulk-edit-image',[
            'item' => $item
        ]);
    }

    public function bulk_update_image(Request $request, Item $item) {
        $attributes=[];
        if ($request->hasFile('item_image')) {
            $attributes['image'] = $request->file('item_image')->store("items",'public');
        }

        $item->update($attributes);

        return redirect()->action([ItemController::class, 'bulk_edit_image'], ['item' => $item ]);
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
