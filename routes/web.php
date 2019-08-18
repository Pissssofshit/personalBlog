<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['namespace'=>'Backend'],function() {
    Route::get('/article/show/{id}', 'ArticleController@show');
    Route::any('/article/{id}/postComment', 'ArticleController@postComment');
    Route::get('/user/show/{id}', 'UsersController@index');
});


Route::group(['namespace'=>'Admins'],function() {
    Route::get('/admin/index', 'HomeController@index');
    Route::get('/admin/usermanager', 'UserController@index');
    Route::get('/admin/commentmanager', 'HomeController@commentManager');

    Route::get('/admins/comments/{id}/edit', 'HomeController@commentEditIndex');
    Route::get('/admins/create_article', 'HomeController@createArticle');
    Route::any('/admins/posts/store', 'HomeController@saveArticle');
    Route::any('/admins/comments/update/{id}', 'HomeController@updateComment');
    Route::any('/admins/comments/delete/{id}', 'HomeController@deleteComment');
//    Route::any('/article/{id}/postComment', 'ArticleController@postComment');
//    Route::get('/user/show/{id}', 'UsersController@index');
});


Route::group(['namespace'=>'Backend', 'prefix'=>'zzh'], function(){
	Route::resource('/zzh', 'ZzhController');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');


Route::get('/post/article', 'HomeController@index')->name('home');
