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

Route::group(['prefix' => '/dashboard', 'middleware' => 'auth', 'namespace' => 'Dashboard'], function () {
    Route::get('/', 'dashboardController@index')->name('dashboard');
    Route::get('/tests', function (){
        return response()->json([
            [
                'id' => 1,
                'name'  => 'zhangsan'
            ],
            [
                'id' => 2,
                'name'  => 'lisi'
            ]
        ]);
    });
    Route::get('/login', function (){
        return response()->json([
            'state' => true,
            'user' => [
                'user_id' => 1,
                'user_name' => 'admin',
            ]
        ]);
    });
});
