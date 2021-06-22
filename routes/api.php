<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);


Route::middleware('jwt.verify')->group(function () {


Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::resource('/categories', App\Http\Controllers\Api\CategoryController::class);

Route::resource('/products', App\Http\Controllers\Api\ProductController::class);

});