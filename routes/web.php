<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthToken;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/auth-token', [AuthToken::class, 'show'])->name('auth-token');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/product/{id}', function () {
    return Inertia\Inertia::render('Product');
})->name('product');

Route::middleware(['auth:sanctum', 'verified'])->get('/product', function () {
    return Inertia\Inertia::render('ProductSubmit');
})->name('product-submit');

Route::middleware(['auth:sanctum', 'verified'])->get('/approved-products', function () {
    return Inertia\Inertia::render('ProductsApproved');
})->name('product-approved');
