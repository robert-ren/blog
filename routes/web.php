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

Route::get('user/all', 'UserController@getUserList')->name('userList')->middleware('auth');

Route::post('user/add', 'UserController@create')->name('userCreate')->middleware('auth');

Route::get('user/{id}', 'UserController@showProfile')->name('profile')->middleware('auth');

Route::post('user/{id}', 'UserController@update')->name('userUpdate')->middleware('auth');

Route::post('password/{id}', 'UserController@updatePassword')->name('passwordUpdate')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');