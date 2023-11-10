<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VelibController;
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



Route::get('/', HomeController::class);
Route::get('/sreach/velib', [VelibController::class, 'sreach'])->name('sreach.velib');
Route::post('/find/velib', [VelibController::class, 'findVelib'])->name('find.velib');
Route::get('/create/velib', [VelibController::class, 'create'])->name('create.velib');
Route::get('/store/velib', [VelibController::class, 'store'])->name('store.velib');
Route::get('/all/stations', [VelibController::class, 'index'])->name('index.velib');
Route::get('/show/station/{station:Identifiant}', [VelibController::class, 'edit'])->name('edit.velib');
Route::put('/update/station/{station}', [VelibController::class, 'update'])->name('update.station');
Route::delete('/delete/velib/{id}', [VelibController::class, 'delete'])->name('delete.velib');
