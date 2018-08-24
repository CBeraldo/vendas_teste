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

Route::prefix('v1')->group(function () {
    Route::prefix('vendedores')->group(function () {
        Route::get('/', 'VendedoresController@getAll');
        Route::get('/{id}', 'VendedoresController@get');
        Route::post('/', 'VendedoresController@insert');
    });

    Route::prefix('vendas')->group(function () {
        Route::get('/', 'VendasController@getAll');
        Route::get('/{id}', 'VendasController@get');
        Route::post('/', 'VendasController@insert');
    });
});