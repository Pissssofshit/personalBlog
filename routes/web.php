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
//    Route::any('/article/{id}/postComment', 'ArticleController@postComment');
//    Route::get('/user/show/{id}', 'UsersController@index');
});


//Route::get('/home','Backend\HomeController@home')->name('pages.show');
//Route::get('/home','Backend\HomeController@home')->name('feeds.main');


//Route::get('/home/selfintro',function(){
//    return view('home');
//})->name('ttt');

//Route::get('/home/selfintros',function(){
//    return view('home');
//})->name('home');

Route::group(['namespace'=>'Backend', 'prefix'=>'zzh'], function(){
	Route::resource('/zzh', 'ZzhController');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');


Route::get('/post/article', 'HomeController@index')->name('home');
