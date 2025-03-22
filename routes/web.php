<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RealEstateWebController;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [RealEstateWebController::class, 'index'])->name('realestates.index');
Route::get('/realestates/create', [RealEstateWebController::class, 'create'])->name('realestates.create');
Route::post('/realestates', [RealEstateWebController::class, 'store'])->name('realestates.store');
Route::get('/realestates/{id}', [RealEstateWebController::class, 'show'])->name('realestates.show');
Route::get('/realestates/{id}/edit', [RealEstateWebController::class, 'edit'])->name('realestates.edit');
Route::put('/realestates/{id}', [RealEstateWebController::class, 'update'])->name('realestates.update');
Route::delete('/realestates/{id}', [RealEstateWebController::class, 'destroy'])->name('realestates.destroy');

Route::post('realestates/{id}/restore', [RealEstateWebController::class, 'restore'])->name('realestates.restore');

Route::delete('realestates/{id}/hard-delete', [RealEstateWebController::class, 'hardDelete'])->name('realestates.hardDelete');
