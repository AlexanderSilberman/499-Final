<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('mymanga', 'DatabaseController@mymanga');


Route::get('login', 'UserController@MakeLogin');

Route::get('signin', 'UserController@MakeSignin');

Route::post('signin', 'UserController@SignIn');

Route::post('login', 'UserController@CreateAccount');

Route::get('logout', 'UserController@LogOut');

Route::get('home', 'DatabaseController@MakeHome');

Route::get('delete', 'DatabaseController@deletemanga');


//Just leaving this here since I only use it if I need to reset the manga database
Route::get('add', 'DatabaseController@add');


Route::get('{title}/{chapter}/{page}', 'MangaController@GetPage');

Route::get('{title}/{chapter}/', 'MangaController@GetFirst');

//Makes all the chapters for a single manga
Route::get('{title}/', 'MangaController@GetChapters');

Route::post('{title}', 'MangaController@FavoriteManga');