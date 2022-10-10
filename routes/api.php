<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

// Route::get('user', 'UserController@index');
// Route::get('user/{id}', 'UserController@show');
// Route::post('user', 'UserController@store');
// Route::put('user/{id}', 'UserController@update');
// Route::delete('user/{id}', 'UserController@destroy');

Route::post('auth', 'AuthController@login');
Route::post('auth-register', 'AuthController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('profile', 'UserController@profile');
    Route::put('profile', 'UserController@updateProfile');
    Route::put('update-password', 'UserController@updatePassword');
    Route::apiResource('user', 'UserController');
    Route::apiResource('role', 'RoleController');
    Route::apiResource('product', 'ProductController');
    Route::apiResource('order', 'OrderController')->only('index', 'show');
    Route::get('exportCSV', 'OrderController@exportCSV');
});
