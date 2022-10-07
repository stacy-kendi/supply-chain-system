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

//Admin Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home1');
Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::resource('supplier', 'App\Http\Controllers\SupplierController');
Route::resource('product', 'App\Http\Controllers\ProductController');

//Supplier Routes
Route::get('/supplierdashboard', [App\Http\Controllers\SupplierDashboardController::class, 'index'])->name('supplierdashboard');
Route::resource('supplierproduct', 'App\Http\Controllers\SupplierProductController');
