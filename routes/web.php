<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
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
    return redirect('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route dei Piatti
Route::middleware(['auth'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dishes/trash', [DishController::class, 'trash'])->name('dishes.trash');
    Route::put('/dishes/{dish}/restore', [DishController::class, 'restore'])->name('dishes.restore');
    Route::delete('/dishes/{dish}/force-delete', [DishController::class, 'forceDelete'])->name('dishes.force-delete');
    Route::resource('dishes', DishController::class);
});

// Route degli ordini
Route::middleware(['auth'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/orders/completed', [OrderController::class, 'completed'])->name('orders.completed');
    Route::resource('orders', OrderController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
