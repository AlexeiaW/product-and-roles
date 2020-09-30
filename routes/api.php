<?php

use App\Http\Controllers\AuthToken;
use App\Http\Controllers\ProductsController;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->get('/approved-products', [ProductsController::class, 'approvedProducts']);
Route::middleware('auth:sanctum')->resource('products', ProductsController::class);
Route::post('/auth-token', AuthToken::class);
