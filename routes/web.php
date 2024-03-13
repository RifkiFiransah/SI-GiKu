<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/backend/dashboard',[DashboardController::class, 'index'])->name('backend.dashboard');
Route::resource('/absensi',DashboardController::class);

Route::get('/users/export_excel', [UserController::class, 'export_excel'])->name('users.excel');
Route::get('/users/export_pdf', [UserController::class, 'export_pdf'])->name('users.pdf');
Route::get('/users/export_csv', [UserController::class, 'export_csv'])->name('users.csv');
Route::get('/users/table', [UserController::class, 'table'])->name('users.table');
Route::resource('/users', UserController::class)->except('create');

require __DIR__.'/auth.php';
