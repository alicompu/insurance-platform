<?php

use App\Http\Controllers\AddressInfoController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//home
Route::post('/insurance-quote', [InsuranceController::class, 'store']);

//personal-info
Route::get('/personal-info-form', [PersonalInfoController::class, 'showForm']);
Route::post('/submit-personal-info', [PersonalInfoController::class, 'store']);

//address-info
Route::get('/address-info-form', [AddressInfoController::class, 'showForm']);
Route::post('/submit-address-info', [AddressInfoController::class, 'store']);

require __DIR__ . '/auth.php';
