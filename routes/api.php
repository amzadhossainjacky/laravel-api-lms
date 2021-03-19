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

//api user 
Route::group([

    'middleware' => 'apiUser',
    'prefix' => 'authUser'

], function ($router) {

    Route::post('login', [App\Http\Controllers\Jwt\User\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\User\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\User\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\User\AuthController::class, 'me']);

});

Route::group([

    'middleware' => 'apiAdmin',
    'prefix' => 'authAdmin'

], function ($router) {

    Route::post('login', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'me']);

    //book route
    Route::get('/book', [App\Http\Controllers\Api\Admin\BookController::class, 'index']);
    Route::post('/book', [App\Http\Controllers\Api\Admin\BookController::class, 'store']);
    Route::get('/book/details/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'show']);
    Route::get('/book/edit/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'edit']);
    Route::get('/book/delete/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'destroy']);
    Route::post('/book/update/{id}', [App\Http\Controllers\Api\Admin\BookController::class, 'update']);

});

/* Route::get('/book', [App\Http\Controllers\Api\Admin\BookController::class, 'index'])->middleware('jwt.auth'); */


/* Route::group(['prefix' => 'authUser','middleware' => ['api','jwt.auth']],function ()
{
	Route::post('login', [App\Http\Controllers\Jwt\User\AuthController::class, 'login']);	
}); */


