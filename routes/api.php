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

    Route::post('/category', 'CategoryController@createCategory')->name('createCategory')/*->middleware(['my.basic', 'isAdmin'])*/;
    Route::put('/category', 'CategoryController@updateCategory')->name('updateCategoryName')/*->middleware(['my.basic', 'isAdmin'])*/;
    Route::delete('/category', 'CategoryController@deleteCategory')->name('deleteCategory')/*->middleware(['my.basic', 'isAdmin'])*/;


    Route::get('/news', 'ArticleController@getAllArticles');
    Route::post('/news/create', 'ArticleController@createArticle')->name('createArticle');
    Route::put('/news/update', 'ArticleController@updateArticle')->name('updateArticle');
    Route::delete('/news/delete', 'ArticleController@deleteArticle')->name('deleteArticle')/*->middleware(['my.basic', 'isAdmin'])*/;
    Route::put('/news/update', 'ArticleController@updateArticle')->name('updateArticle');
    Route::delete('/news/delete', 'ArticleController@deleteArticle')->name('deleteArticle');
    Route::delete('/news/delete/{id}', 'ArticleController@deleteArticle')->name('deleteArticle');
    Route::put('/news/update/active-status/{id}', 'ArticleController@changeIsActiveStatus')/*->name('changeIsActive')*/;
    Route::post('/news/update/main/{id}', 'ArticleController@setMain')->name('setIsMain');


});

/*CLIENT routes*/
Route::get('/user/get/{id}', 'UserController@getById')->name('getUserById');
Route::post('/user/register', 'AuthController@registerUser')->name('registerUser')->middleware(['user.exist']);
Route::post('/user/login', 'AuthController@loginUser')->name('loginUser')->middleware(['my.basic']);


/*Category routes*/
Route::get('/categories', 'CategoryController@all')->name('getAllCategories');

/*Articles routes*/
Route::get('/news', 'ArticleController@getArticles')->name('getArticles');
Route::get('/news/by-cat/{id}', 'ArticleController@getArticlesByCategory');
Route::get('/news/{url}', 'ArticleController@getArticleByUrl')->name('getArticleByUrl');
Route::get('/news/get/main', 'ArticleController@getMain');



/* Comments routes */
Route::get('/comments', 'CommentController@getAllComments');
Route::get('/comments/{articleId}', 'ArticleController@getCommentsByArticle');
Route::post('/comment', 'CommentController@store')->middleware(['my.basic', 'isUser']);
