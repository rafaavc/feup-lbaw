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
// Home
Route::view('/', 'pages.index');
Route::get('/recipe/{id}', 'RecipeController@view');
Route::get('/recipe/{recipeId}/edit', 'RecipeController@edit');
Route::post('/recipe/{recipeId}/edit', 'RecipeController@editPost');
Route::get('/recipe', 'RecipeController@create');
Route::post('/recipe', 'RecipeController@createRecipe');

//Home
Route::view('/', 'pages.index');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Content visualization
Route::get('/recipe/{id}', 'RecipeController@view');

// Content creation
Route::get('/recipe', 'RecipeController@create');

