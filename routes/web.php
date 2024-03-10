<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\ProductController::class, 'showList'])->name('home');
Route::get('/home/search', [App\Http\Controllers\ProductController::class, 'search'])->name('search');
Route::get('/register', [App\Http\Controllers\ProductController::class, 'showRegister'])->name('show.register');
Route::post('/exe_register', [App\Http\Controllers\ProductController::class, 'register'])->name('register');
Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'showDetail'])->name('show.detail');
Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'showEdit'])->name('show.edit');

Route::post('/exe_update', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
Route::get('/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');


