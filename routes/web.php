<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\CripController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\ProfileController;
use App\Models\NilaiAlternatif;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(
    function () {
        Route::resource('/kriteria', KriteriaController::class);
        Route::resource('/crip', CripController::class);
        Route::resource('/alternatif', AlternatifController::class);
        Route::resource('/nilai', NilaiAlternatifController::class);
        Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
    }
);

require __DIR__ . '/auth.php';
