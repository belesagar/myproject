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

Route::get('testangular','LoginController@index')->name('testangular');
Route::get('getdata','LoginController@getdata')->name('getdata');
// Route::get('login','LoginController@login')->name('login');
Route::get('signup','LoginController@signup')->name('signup');
Route::post('checksignup','LoginController@checkSignup')->name('checksignup');

Route::get('home', 'FranchisePanalController@home')->name('home');
Route::get('dashboard', 'FranchisePanalController@dashboard')->name('dashboard');
Route::get('user/list', 'FranchisePanalController@getUserListData')->name('users');