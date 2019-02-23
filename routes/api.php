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

//Route::get('/user', function (Request $request) {
//    return dd(1);
//});

Route::get('/test', function(){
    return response()->json('fdjjdfjf');
});

Route::get('news/', 'FixturesController@showNews');

Route::get('news/{id}', 'FixturesController@showOneNew');
