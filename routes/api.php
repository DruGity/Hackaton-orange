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
Route::get('/category/all', 'CategoryController@all')->name('getAllCategories');
Route::get('/category/{url}', 'CategoryController@getById')->name('getCategoryById');
Route::get('/category/user/{name}', 'CategoryController@getByUserId')->name('getCategoryByUserId');
Route::post('/category/create', 'CategoryController@createCategory')->name('createCategory');
Route::post('/category/update/{url}', 'CategoryController@updateName')->name('updateCategoryName');


/* Comments routes */
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/comments/{id}', 'CommentController@getCommentById');
Route::get('/comments/article/{articleId}', 'CommentController@getCommentByArticleId');

