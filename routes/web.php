<?php

use App\Http\Controllers\CodeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/codes', [CodeController::class, 'index'])->name('codes.index');

Route::get('/codes/create', [CodeController::class, 'create'])->name('codes.create');
Route::post('/codes', [CodeController::class, 'store'])->name('codes.store');

Route::get('/codes/delete', [CodeController::class, 'delete'])->name('codes.delete');
Route::delete('/codes/delete', [CodeController::class, 'destroy'])->name('codes.destroy');

Auth::routes();

Route::get('/custom-logout', [HomeController::class, 'index'])->name('custom-logout');
