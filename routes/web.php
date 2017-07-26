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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => '/dashboard', 'namespace' => 'Api', 'middleware' => 'auth'], function () {
    Route::post('/posts/upload', 'postsController@upload');
    Route::resource('/categorys', 'categorysController');
    Route::resource('/posts', 'postsController');
    Route::resource('/files', 'filesController');
    Route::get('dirs', 'filesController@dirs');
});

Route::group(['prefix' => '/dashboard', 'namespace' => 'Api'], function () {
    Route::get('/', function (){
        return view('dashboard.index');
    })->name('dashboard');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/check', 'AuthController@check');
});
