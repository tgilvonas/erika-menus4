<?php

use App\Http\Controllers\IngredientsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ingredients', [IngredientsController::class, 'index'])->name('ingredients.index');
    Route::get('/ingredients/json-list', [IngredientsController::class, 'getJsonList'])->name('ingredients.json_list');
    Route::post('/ingredients/save', [IngredientsController::class, 'save'])->name('ingredients.save');
    Route::post('/ingredients/delete', [IngredientsController::class, 'delete'])->name('ingredients.delete');
});

require __DIR__.'/auth.php';
