<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Catalog;
use App\Imports\ItemsImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Storage;
class ItemController extends Controller
{
    public function delete_all(Catalog $catalog) {
        $items = Item::where('catalog_id', $catalog['id'])->get();
        if (empty($items)) {
            abort(404, 'No items in this catalog to delete!');
        }
        foreach ($items as $item)
        {
            if (!empty($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
            $item->delete();
        }
        return redirect('/catalogs/'.$catalog['id'].'/items');
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
            return redirect('/catalogs/'.$catalog['id'].'/items')->withErrors([
                'import_items' => $error_message,
            ]);
        }

        return redirect('/catalogs/'.$catalog['id'].'/items');
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
    public function bulk_edit_image(Catalog $catalog)
    {
        return view('items.index',[
            'catalog' => $catalog,
            'edit' => true
        ]);
    }

    public function bulk_update_image(Request $request, Item $item) {
        $attributes=[];
        if ($request->hasFile('item_image_'.$item['id'])) {
            if (!empty($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
            $attributes['image'] = $request->file('item_image_'.$item['id'])->store("items",'public');
        }

        $item->update($attributes);

        return redirect()->action([ItemController::class, 'bulk_edit_image'], ['catalog' => $item->catalog]);
    }

    public function bulk_update_image_ajax(Request $request, Item $item) {

            if ($request->hasFile('item_image_' . $item["id"])) {
                if (!empty($item['image'])) {
                    Storage::disk('public')->delete($item['image']);
                }
                $image = $request->file('item_image_' . $item["id"]);
                $item->image = $image->store("items", "public"); // Store the image
                $item->save();

                return response()->json([
                    'success' => true,
                    'image_url' => asset($item["image"]),
                ]);
            }

            return response()->json(['success' => false], 400);
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
            if (!empty($item['image'])) {
                Storage::disk('public')->delete($item['image']);
            }
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
        if (!empty($item['image'])) {
            Storage::disk('public')->delete($item['image']);
        }
        $catalog = $item->catalog;
        $item->delete();
        return view('items.index', [
            'catalog' => $catalog
        ]);
    }
}
