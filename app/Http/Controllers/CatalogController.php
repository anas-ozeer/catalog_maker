<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Browsershot::html('Foo')
    ->setNodeBinary('/usr/local/bin/node')
    ->setNpmBinary('/usr/local/bin/npm');
class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('catalogs.index', [
            'catalogs' => Catalog::latest()->get()
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
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => 'nullable',
            'logo' => 'nullable|image'
        ]);
        if ($request->hasFile('logo')) {
            $attributes['logo'] = $request['logo']->store('logos', 'public');
        }

        $attributes['user_id'] = Auth::id();

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
        // Validate the fields and store them
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'description' => 'nullable',
            'logo' => 'nullable|image'
        ]);
        if ($request->hasFile('logo')) {
            $attributes['logo'] = $request['logo']->store('logos', 'public');
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



    public function download_as_pdf(Catalog $catalog)
    {

        // Render the Blade view to HTML
        $html = view('pdfs.test-pdf', [
            'catalog' => $catalog
        ])->render();

        // Correctly handle paths with spaces
        $nodePath = '/Users/sheikanasallyozeer/Library/Application\\ Support/Herd/config/nvm/versions/node/v20.15.0/bin/node';
        $npmPath = '/Users/sheikanasallyozeer/Library/Application\\ Support/Herd/config/nvm/versions/node/v20.15.0/bin/npm';

        Browsershot::html($html)
            ->setNodeBinary($nodePath)
            ->setNpmBinary($npmPath)
            ->format('a4')
            ->save('file.pdf');

        // Return a response to the user
        return back();

    }
}

