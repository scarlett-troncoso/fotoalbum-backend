<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\CategoryController;

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

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function(){
    /*Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');*/ // questa rotta ha sólo il preffisso admin /admin
    Route::get('/', [PhotoController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard'); // In tanto che non ho una dashboard sto direzionando diretamente a tutte le foto, dopo di aver effetuato il login
    Route::resource('photos', PhotoController::class)
    ->parameters([ //slug anziché l'id nell path della pagina
        'photos' => 'photo:slug'
    ]);

    Route::resource('categories', CategoryController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
