<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use function Spatie\LaravelPdf\Support\pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
class CatalogController extends Controller
{
    /**
     * Display all listing of the resource.
     */
    public function view_all()
    {
        return view('dashboard', [
            'catalogs' => Catalog::latest()->get()
        ]);
    }
    /**
     * Display listings of the resource.
     */
    public function index()
    {
        $catalogs = Auth::user()->catalogs;
        return view('catalogs.index', [
            'catalogs' => $catalogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the fields and store them
        $request->validate([
            'catalog_name' => ['required', 'min:3'],
            'catalog_description' => ['nullable','string', 'max:255'],
            'cover' => 'nullable|image'
        ]);

        $attributes = [
            'name' => $request['catalog_name'],
            'description' => $request['catalog_description'],
            'user_id' => Auth::id()
        ];

        if ($request->hasFile('cover')) {
            $attributes['cover'] = $request->file('cover')->store("catalogs", 'public');
        }

        Catalog::create($attributes);

        return redirect('/catalogs/index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Catalog $catalog)
    {
        return view('catalogs.show', [
            'catalog' => $catalog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog)
    {
        return view('catalogs.edit', [
            'catalog' => $catalog
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalog $catalog)
    {
        // Validate the fields and update them
        $request->validate([
            'catalog_name' => ['required', 'min:3'],
            'catalog_description' => ['nullable','string', 'max:255'],
            'cover' => 'nullable|image'
        ]);

        $attributes = [
            'name' => $request['catalog_name'],
            'description' => $request['catalog_description'],
            'user_id' => Auth::id()
        ];

        if ($request->hasFile('cover')) {
            $attributes['cover'] = $request->file('cover')->store("catalogs", 'public');
        }

        $catalog->update($attributes);

        return redirect('/catalogs/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog)
    {
        $catalog->delete();
        return redirect('catalogs/index');
    }


    // This function is not used to performance issues
    // public function download_as_pdf(Catalog $catalog)
    // {

    //     $html = view('pdfs.catalog', [
    //         'catalog' => $catalog
    //     ])->render();

    //     // Correctly handle paths with spaces
    //     $nodePath = '/Users/sheikanasallyozeer/Library/Application\\ Support/Herd/config/nvm/versions/node/v20.15.0/bin/node';
    //     $npmPath = '/Users/sheikanasallyozeer/Library/Application\\ Support/Herd/config/nvm/versions/node/v20.15.0/bin/npm';

    //     $pdf = Browsershot::html($html)
    //     ->setNodeBinary($nodePath)
    //     ->setNpmBinary($npmPath)
    //     ->margins(0,0,0,0)
    //     ->format('a4')
    //     ->pdf();

    //     return response($pdf, 200, [
    //         'Content-Type' => 'application/pdf'
    //     ]);
    // }

    public function view_pdf(Catalog $catalog)
    {
        return view('pdfs.catalog',[
            'catalog' => $catalog
        ]);
    }
}

