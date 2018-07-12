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

//Route::get('user/{id}', function ($id) {
//    return 'User ' . $id;
//});

Route::get('user/all', 'UserController@getUserList')->name('user_list')->middleware('auth');

Route::get('user/add', 'UserController@create');

Route::post('user/add', 'UserController@created')->middleware('auth');

Route::get('user/{id}', 'UserController@showProfile')->name('profile')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');