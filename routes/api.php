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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('/book', [App\Http\Controllers\Api\Admin\BookController::class, 'index']);
Route::post('/book', [App\Http\Controllers\Api\Admin\BookController::class, 'store']);
Route::get('/book/details/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'show']);
Route::get('/book/edit/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'edit']);
Route::get('/book/delete/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'destroy']);
Route::post('/book/update/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'update']);
