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

/*User routes*/
Route::get('/user/get/{id}', 'UserController@getById')->name('getUserById');
Route::post('/user/create', 'UserController@createUser')->name('createUser');

/*Category routes*/
Route::get('/categories/all', 'CategoryController@all')->name('getAllCategories');
Route::get('/categories/get/{id}', 'CategoryController@getById')->name('getCategoryById');
Route::get('categories/user/{id}', 'CategoryController@getByUserId')->name('getCategoryByUserId');
Route::post('/categories/create', 'CategoryController@createCategory')->name('createCategory');
Route::post('/categories/update/{id}', 'CategoryController@updateName')->name('updateCategoryName');
