<?php
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[CatalogController::class, 'view_all'])->middleware(['auth', 'verified'])->name('dashboard');

//Import Items
Route::post('/catalogs/{catalog}/import_items',[ItemController::class, 'import'])->name('import')->middleware(['auth', 'verified'])->can('modify_catalog','catalog');

// Catalog
Route::get('/catalogs/index', [CatalogController::class, 'index'])->middleware(['auth', 'verified'])->name('catalogs.index');
Route::get('/catalogs/create', [CatalogController::class, 'create'])->middleware(['auth', 'verified'])->name('catalogs.create');
Route::get('/catalogs/{catalog}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit')->middleware(['auth', 'verified'])->can('modify_catalog','catalog');
Route::get('/catalogs/{catalog}', [CatalogController::class, 'show'])->name('catalogs.show')->middleware(['auth', 'verified']);
Route::patch('/catalogs/{catalog}', [CatalogController::class, 'update'])->middleware(['auth', 'verified'])->can('modify_catalog','catalog');
Route::post('/catalogs', [CatalogController::class, 'store'])->middleware(['auth', 'verified']);
Route::delete('/catalogs/{catalog}', [CatalogController::class, 'destroy'])->middleware(['auth', 'verified'])->can('modify_catalog','catalog');
Route::get('/catalogs/{catalog}/pdf-download', [CatalogController::class, 'view_pdf'])->middleware(['auth', 'verified']);



// Item
Route::get('/items/{item}',[ItemController::class, 'show'])->name('items.show')->middleware(['auth', 'verified']);
Route::get('/catalogs/{catalog}/items', [ItemController::class, 'index'])->name('items.index')->middleware(['auth', 'verified']);
Route::post('/items', [ItemController::class, 'store'])->middleware(['auth', 'verified']);
Route::patch('/items/{item}', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->can('modify_item', 'item');
Route::delete('items/{item}',[ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->can('modify_item', 'item');
Route::get('/catalogs/{catalog}/delete_all', [ItemController::class, 'delete_all'])->middleware(['auth', 'verified'])->can('modify_catalog','catalog');
Route::get('/items/{item}/bulk_edit_image', [ItemController::class, 'bulk_edit_image'])->middleware(['auth', 'verified'])->can('modify_item', 'item');
Route::patch('/items/{item}/bulk_update_image', [ItemController::class, 'bulk_update_image'])->middleware(['auth', 'verified'])->can('modify_item', 'item');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
