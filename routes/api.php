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
Route::post('/category/delete/{url}', 'CategoryController@deleteCategory')->name('deleteCategory');
Route::post('/category/update', 'CategoryController@updateName')->name('updateCategoryName');
Route::post('/category/delete', 'CategoryController@deleteCategory')->name('deleteCategory');

/*Articles routes*/
Route::get('/news', 'ArticleController@getArticles')->name('getArticles');
Route::get('/news/{url}', 'ArticleController@getArticleById')->name('getArticleById');
Route::post('/news/create', 'ArticleController@createArticle')->name('createArticle');
Route::post('/news/update', 'ArticleController@updateArticle')->name('updateArticle');
Route::post('/news/delete', 'ArticleController@deleteArticle')->name('deleteArticle');


/* Comments routes */
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/comments/{articleId}', 'ArticleController@getCommentsByArticle');

