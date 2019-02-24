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
/*ADMIN routes*/

Route::prefix('admin')->group(function () {

    Route::post('/category', 'CategoryController@createCategory')->name('createCategory')->middleware(['my.basic', 'isAdmin']);
    Route::put('/category', 'CategoryController@updateCategory')->name('updateCategoryName')->middleware(['my.basic', 'isAdmin']);
    Route::delete('/category', 'CategoryController@deleteCategory')->name('deleteCategory')->middleware(['my.basic', 'isAdmin']);


    Route::post('/news/create', 'ArticleController@createArticle')->name('createArticle');
    Route::put('/news/update', 'ArticleController@updateArticle')->name('updateArticle');
    Route::delete('/news/delete', 'ArticleController@deleteArticle')->name('deleteArticle')->middleware(['my.basic', 'isAdmin']);
    Route::put('/news/update/active-status', 'ArticleController@changeIsActiveStatus')->name('changeIsActive')->middleware(['my.basic', 'isAdmin']);

});

/*CLIENT routes*/
Route::get('/user/get/{id}', 'UserController@getById')->name('getUserById');
Route::post('/user/register', 'AuthController@registerUser')->name('registerUser')->middleware(['user.exist']);

/*Category routes*/
Route::get('/categories', 'CategoryController@all')->name('getAllCategories');

/*Articles routes*/
Route::get('/news', 'ArticleController@getArticles')->name('getArticles');
Route::get('/news/by-cat/{id}', 'ArticleController@getArticlesByCategory');
Route::get('/news/{url}', 'ArticleController@getArticleByUrl')->name('getArticleByUrl');
Route::get('/news/main', 'ArticleController@getMain');
Route::post('/news/main', 'ArticleController@setIsMain')->name('setIsMain');



/* Comments routes */
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/comments/{articleId}', 'ArticleController@getCommentsByArticle');
Route::post('/comment', 'CommentController@store')->middleware(['my.basic', 'isUser']);
