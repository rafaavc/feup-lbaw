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

// Recipe
Route::get('/recipe/{recipe}', 'RecipeController@view')->middleware('can:select,recipe');
Route::post('/recipe/{recipe}/delete', 'RecipeController@deleteAction')->middleware('can:delete,recipe');
Route::get('/recipe/{recipe}/edit', 'RecipeController@edit')->middleware('can:update,recipe');
Route::post('/recipe/{recipe}/edit', 'RecipeController@editPost')->middleware('can:update,recipe');
Route::get('/recipe', 'RecipeController@create')->middleware('can:insert,App\Models\Recipe');
Route::post('/recipe', 'RecipeController@createRecipe')->middleware('can:insert,App\Models\Recipe');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// ----------------------------------------------------------------
// User pages
// ----------------------------------------------------------------
Route::get('user/{user}/recipes', 'MemberController@readRecipes')->middleware('can:view,user');
Route::get('user/{user}/favourites', 'MemberController@readFavourites')->middleware('can:view,user');
Route::get('user/{user}/reviews', 'MemberController@readReviews')->middleware('can:view,user');
Route::get('user/{user}/edit', 'MemberController@update')->middleware('can:view,user');
Route::post('user/{user}/edit', 'MemberController@updateAction')->middleware('can:update,user');
Route::get('user/{user}/delete', 'MemberController@deleteAction')->middleware('can:delete,user');
Route::get('user/{user}/{any?}', 'MemberController@redirect')->where('any', '.*')->middleware('can:view,user');

// Frequently Asked Questions
Route::get('faq', 'FaqController@view');
