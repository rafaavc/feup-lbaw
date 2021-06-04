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

Route::view('/', 'pages.index')->name('homepage');
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

Route::get('forgot_password', 'Auth\ForgotPasswordController@viewforgot');
Route::post('forgot_password', 'Auth\ForgotPasswordController@forgot');
Route::get('reset_password/{token}', 'Auth\ForgotPasswordController@viewReset');
Route::post('reset_password', 'Auth\ForgotPasswordController@reset');

// ----------------------------------------------------------------
// User pages
// ----------------------------------------------------------------
Route::get('user/{user}/recipes', 'MemberController@readRecipes');
Route::get('user/{user}/favourites', 'MemberController@readFavourites');
Route::get('user/{user}/reviews', 'MemberController@readReviews');
Route::get('user/{user}/edit', 'MemberController@update')->middleware('can:update,user');
Route::post('user/{user}/edit', 'MemberController@updateAction')->middleware('can:update,user');
Route::get('user/{user}/{any?}', 'MemberController@redirect')->where('any', '.*');

Route::get('admin/users', 'MemberController@list')->middleware('IsAdmin');

// ----------------------------------------------------------------
// Recipe pages
// ----------------------------------------------------------------
Route::get('/recipe/{recipe}', 'RecipeController@view')->middleware('can:select,recipe')->where('recipe', '[0-9]+');
Route::post('/recipe/{recipe}/delete', 'RecipeController@deleteAction')->middleware('can:delete,recipe')->where('recipe', '[0-9]+');
Route::get('/recipe/{recipe}/edit', 'RecipeController@edit')->middleware('can:update,recipe')->where('recipe', '[0-9]+');
Route::post('/recipe/{recipe}/edit', 'RecipeController@editPost')->middleware('can:update,recipe')->where('recipe', '[0-9]+');
Route::get('/recipe', 'RecipeController@create')->middleware('can:insert,App\Models\Recipe');
Route::post('/recipe', 'RecipeController@createRecipe')->middleware('can:insert,App\Models\Recipe');

// ----------------------------------------------------------------
// Group pages
// ----------------------------------------------------------------
Route::get('group/{group}', 'GroupController@view')->where('group', '[0-9]+');
Route::get('group/{group}/edit', 'GroupController@update')->middleware('can:update,group')->where('group', '[0-9]+');
Route::post('group/{group}/edit', 'GroupController@updateAction')->middleware('can:update,group')->where('group', '[0-9]+');
Route::get('group/{group}/delete', 'GroupController@deleteAction')->middleware('can:delete,group')->where('group', '[0-9]+');
Route::get('group', 'GroupController@create')->middleware('can:create,App\Models\Group');
Route::post('group', 'GroupController@createAction')->middleware('can:create,App\Models\Group');

Route::get('group/{group}/recipe', 'RecipeController@create')->where('group', '[0-9]+'); // TODO: add this to the openapi

// ----------------------------------------------------------------
// List pages
// ----------------------------------------------------------------
Route::get('category/{category}', 'CategoryController@view')->where('category', '[0-9]+');
Route::get('feed', 'FeedController@view');
Route::get('search', 'SearchController@view');

// ----------------------------------------------------------------
// Chat pages
// ----------------------------------------------------------------
Route::get('chat', 'ChatController@view');
Route::get('message', 'ChatController@fetchMessages');
Route::post('message', 'ChatController@sendMessage');

// ----------------------------------------------------------------
// Report pages
// ----------------------------------------------------------------
Route::get('admin/reports', 'ReportController@list');

// ----------------------------------------------------------------
// Fallback
// ----------------------------------------------------------------
Route::fallback(function () {
    return view('errors.404');
});
