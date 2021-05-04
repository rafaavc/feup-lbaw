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
Route::post('/recipe/{id}/delete', 'RecipeController@deleteAction');
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

// ----------------------------------------------------------------
// User pages
// ----------------------------------------------------------------
Route::get('/user/{user}/recipes', 'MemberController@readRecipes')->middleware('can:view,user');
Route::get('/user/{user}/favourites', 'MemberController@readFavourites')->middleware('can:view,user');
Route::get('/user/{user}/reviews', 'MemberController@readReviews')->middleware('can:view,user');
Route::get('/user/{user}/edit', 'MemberController@update')->middleware('can:view,user');
Route::post('/user/{user}/edit', 'MemberController@updateAction')->middleware('can:update,user');
Route::post('/user/{user}/delete', 'MemberController@deleteAction')->middleware('can:delete,user');
Route::get('/user/{user}/{any?}', 'MemberController@redirect')->where('any', '.*')->middleware('can:view,user');
