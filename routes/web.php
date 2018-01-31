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

//Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/category/{cat_id}', 'HomeController@category')->name('category');
Route::get('/post/{slug}', 'HomeController@post')->name('post');
Route::get('/tag/{tag_id}', 'HomeController@tag')->name('tag');
Route::get('/demo', 'DemoController@index');
Route::get('/comment/{post_id}', 'CommentsController@comment');
Route::post('/comment', 'CommentsController@store');
Route::get('/search/{key}', 'HomeController@search')->name('search');



Route::group(['prefix' => '/dashboard', 'namespace' => 'Api', 'middleware' => 'auth'], function () {
    Route::post('/posts/upload', 'PostsController@upload');
    Route::resource('/categorys', 'CategorysController');
    Route::resource('/posts', 'PostsController');
    Route::resource('/files', 'FilesController');
    Route::get('/dirs', 'FilesController@dirs');
    Route::resource('/tags', 'TagsController');
    Route::get('/main', 'MainController@getData');
    Route::resource('/comments', 'CommentsController');
    Route::get('/trans/{query}', 'TransController@trans');
});

Route::group(['prefix' => '/dashboard', 'namespace' => 'Api'], function () {
    Route::get('/', function (){
        return view('dashboard.index');
    })->name('dashboard');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/check', 'AuthController@check');
});


