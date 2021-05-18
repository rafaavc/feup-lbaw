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

// ----------------------------------------------------------------
// Static pages
// ----------------------------------------------------------------
Route::view('/', 'pages.index');
Route::get('faq', 'FaqController@view');
Route::get('about', 'AboutController@view');

// ----------------------------------------------------------------
// Authentication pages
// ----------------------------------------------------------------
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// ----------------------------------------------------------------
// User pages
// ----------------------------------------------------------------
Route::get('user/{user}/recipes', 'MemberController@readRecipes');
Route::get('user/{user}/favourites', 'MemberController@readFavourites');
Route::get('user/{user}/reviews', 'MemberController@readReviews');
Route::get('user/{user}/edit', 'MemberController@update')->middleware('can:update,user');
Route::post('user/{user}/edit', 'MemberController@updateAction')->middleware('can:update,user');
Route::get('user/{user}/delete', 'MemberController@deleteAction')->middleware('can:delete,user');
Route::get('user/{user}/{any?}', 'MemberController@redirect')->where('any', '.*');
Route::get('admin/users', 'MemberController@list')->middleware('can:list,App\Models\Member');

// ----------------------------------------------------------------
// Recipe pages
// ----------------------------------------------------------------
Route::get('/recipe/{recipe}', 'RecipeController@view')->middleware('can:select,recipe');
Route::post('/recipe/{recipe}/delete', 'RecipeController@deleteAction')->middleware('can:delete,recipe');
Route::get('/recipe/{recipe}/edit', 'RecipeController@edit')->middleware('can:update,recipe');
Route::post('/recipe/{recipe}/edit', 'RecipeController@editPost')->middleware('can:update,recipe');
Route::get('/recipe', 'RecipeController@create')->middleware('can:insert,App\Models\Recipe');
Route::post('/recipe', 'RecipeController@createRecipe')->middleware('can:insert,App\Models\Recipe');

// ----------------------------------------------------------------
// Group pages
// ----------------------------------------------------------------
Route::get('group/{group}', 'GroupController@view');
Route::get('group/{group}/edit', 'GroupController@update')->middleware('can:update,group');
Route::post('group/{group}/edit', 'GroupController@updateAction')->middleware('can:update,group');
Route::get('group/{group}/delete', 'GroupController@deleteAction')->middleware('can:delete,group');
Route::get('group', 'GroupController@create')->middleware('can:create,App\Models\Group');
Route::post('group', 'GroupController@createAction')->middleware('can:create,App\Models\Group');

// ----------------------------------------------------------------
// List pages
// ----------------------------------------------------------------
Route::get('category/{category}', 'CategoryController@view');
Route::get('feed', 'FeedController@view');
Route::get('search', 'SearchController@view');

// ----------------------------------------------------------------
// Chat pages
// ----------------------------------------------------------------
Route::get('chat/{user}', 'ChatController@view');

// ----------------------------------------------------------------
// Report pages
// ----------------------------------------------------------------
Route::get('admin/reports', 'ReportController@list');

