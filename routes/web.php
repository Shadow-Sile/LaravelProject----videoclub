<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CatalogController::class,'index'])->name('catalog.index');

Route::get('/catalog', [CatalogController::class,'index'])->name('catalog.index');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/catalog/show/{id}', [CatalogController::class, "show"]) ->name('catalog.show');

Route::get('/catalog/create', [CatalogController::class, "create"] ) ->name('catalog.create');

Route::put('/catalog/new', [CatalogController::class, 'new']) ->name('catalog.new');

Route::put('/catalog/update/{id}', [CatalogController::class, 'update']) ->name('catalog.update');

Route::get('/catalog/edit/{id}', [CatalogController::class, "edit"]) ->name('catalog.edit');

Route::delete('/catalog/show/{id}', [CatalogController::class, 'destroy'])->name('catalog.destroy');

Route::patch('/catalog/{id}/rent', [CatalogController::class, 'rent']) ->name('catalog.rent');

Route::patch('/catalog/{id}/return', [CatalogController::class, 'return']) ->name('catalog.return');