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


/*User routes*/
Route::get('/user/get/{id}', 'UserController@getById')->name('getUserById');
Route::post('/user/create', 'UserController@createUser')->name('createUser');

/*Category routes*/
Route::get('/category/all', 'CategoryController@all')->name('getAllCategories');
Route::post('/category/create', 'CategoryController@createCategory')->name('createCategory');
Route::put('/category/update', 'CategoryController@updateCategory')->name('updateCategoryName');
Route::delete('/category/delete', 'CategoryController@deleteCategory')->name('deleteCategory');

/*Articles routes*/
Route::get('/news', 'ArticleController@getArticles')->name('getArticles');
Route::get('/news/by-cat/{id}', 'ArticleController@getArticlesByCategory');
Route::get('/news/{url}', 'ArticleController@getArticleById')->name('getArticleById');
Route::post('/news/create', 'ArticleController@createArticle')->name('createArticle');
Route::put('/news/update', 'ArticleController@updateArticle')->name('updateArticle');
Route::delete('/news/delete', 'ArticleController@deleteArticle')->name('deleteArticle');


/* Comments routes */
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/comments/{articleId}', 'ArticleController@getCommentsByArticle');

