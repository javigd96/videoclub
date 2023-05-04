<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CatalogoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('films',FilmController::class)->middleware(['auth','verified']);
Route::resource('catalogo',CatalogoController::class)->middleware(['auth','verified']);

Route::get('/catalogo/{film}/rent',[CatalogoController::class, 'rent'])->name('catalogo.rent');
Route::get('/catalogo/{film}/rent2',[CatalogoController::class, 'rent2'])->name('catalogo.rent2');
Route::put('/catalogo/{film}/rent',[CatalogoController::class, 'rent'])->name('catalogo.rent');
Route::put('/catalogo/{film}/rent2',[CatalogoController::class, 'rent2'])->name('catalogo.rent2');

Route::get('/film/{film}', [FilmController::class, 'edit'])->name('film.edit');
Route::put('/film/{film}', [FilmController::class, 'destroy'])->name('film.destroy');

require __DIR__.'/auth.php';
