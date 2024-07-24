<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Catalog Resource
Route::get('/catalogs/index', [CatalogController::class, 'index'])->middleware(['auth', 'verified'])->name('catalogs.index');
Route::get('/catalogs/create', [CatalogController::class, 'create'])->middleware(['auth', 'verified'])->name('catalogs.create');
Route::get('/catalogs/{catalog}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit')->middleware(['auth', 'verified']);
Route::get('/catalogs/{catalog}', [CatalogController::class, 'show'])->name('catalogs.show')->middleware(['auth', 'verified']);
Route::patch('/catalogs/{catalog}', [CatalogController::class, 'update'])->middleware(['auth', 'verified']);
Route::post('/catalogs', [CatalogController::class, 'store'])->middleware(['auth', 'verified']);
Route::delete('/catalogs/{catalog}', [CatalogController::class, 'destroy'])->middleware(['auth', 'verified']);

// Item Resource
Route::post('/items', [ItemController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/items/{item}',[ItemController::class, 'show'])->middleware(['auth', 'verified']);
Route::patch('/items/{item}', [ItemController::class, 'update'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
