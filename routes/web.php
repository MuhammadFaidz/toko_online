<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MedicineController;
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

Route::get('/', [Controller::class, 'landing'])->name('home');

Route::prefix('/medicines')->name('medicines.')->group(function(){
    Route::get('/add', [MedicineController::class, 'create'])->name('create');
    Route::post('/add', [MedicineController::class, 'store'])->name('store');
    Route::get('/', [MedicineController::class, 'index'])->name('index');
    // {id} : path dinamis berisi data id, path dinamis untuk mencari spesifikasi data berdasarkan field tertentu
    Route::delete('/delete/{id}', [MedicineController::class, 'destroy'])->name('delete');
    Route::get('/edit/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::patch('/edit/{id}', [MedicineController::class, 'update'])->name('update');
});
