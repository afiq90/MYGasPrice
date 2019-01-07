<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('register', 'AuthController@register');
// Route::post('login', 'AuthController@login');
Route::apiResource('books', 'BookController');
Route::post('books/{book}/ratings', 'RatingController@store');

//Register & login user API
Route::post('register', 'PassportController@register');
Route::post('login', 'PassportController@login');

Route::get('search/{s}', 'GasControllerAPI@search');
// Route::get('search/', 'GasControllerAPI@search');

// Gas API
// Route::get('gas', 'GasController@index');
//Need to put GasControllerAPI into auth middleware for authentication
Route::middleware('auth:api')->group(function() {
    Route::get('user', 'PassportController@details');
    // Route::get('search', 'GasControllerAPI@search');
    Route::resource('gas', 'GasControllerAPI');
});
// Route::resource('gas', 'GasControllerAPI');