<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'Auth\LoginController@getUser');

// API - TasteBuds

Route::post('recipe', 'RecipeController@insert')->middleware('can:insert,App\Models\Recipe');
Route::get('recipe/{recipe}', 'RecipeController@select')->middleware('can:select,recipe');
Route::put('recipe/{recipe}', 'RecipeController@update')->middleware('can:update,recipe');
Route::delete('recipe/{recipe}', 'RecipeController@delete')->middleware('can:delete,recipe');

Route::get('units', 'UnitController@index');

Route::post('recipe/{recipe}/favourite', 'RecipeController@addToFavourites')->middleware('can:addToFavourites,recipe');
Route::delete('recipe/{recipe}/favourite', 'RecipeController@removeFromFavourites')->middleware('can:removeFromFavourites,recipe');

Route::post('comment', 'CommentController@insert')->middleware('can:insert,App\Models\Comment');

// ----------------------------------------------------------------
// User API
// ----------------------------------------------------------------
Route::post('user', 'MemberController@post')->middleware('can:create,user');
Route::get('user/{user}', 'MemberController@get');
Route::get('user/{user}/recipes', 'MemberController@getRecipes')->middleware('can:view,user');
Route::get('user/{user}/reviews', 'MemberController@getReviews')->middleware('can:view,user');
Route::get('user/{user}/favourites', 'MemberController@getFavourites')->middleware('can:view,user');
Route::get('user/{user}/following', 'MemberController@getFollowing')->middleware('can:view,user');
Route::get('user/{user}/followers', 'MemberController@getFollowers')->middleware('can:view,user');
Route::get('user/{user}/groups', 'MemberController@getGroups')->middleware('can:view,user');
Route::put('user/{user}', 'MemberController@put')->middleware('can:update,user');
Route::delete('user/{user}', 'MemberController@remove')->middleware('can:delete,user');
Route::post('user/{user}/request', 'MemberController@followRequest')->middleware('can:follow,user');
Route::delete('user/{user}/request', 'MemberController@deleteFollowRequest')->middleware('can:deleteFollow,user');

// ----------------------------------------------------------------
// Search API
// ----------------------------------------------------------------
Route::get('search/recipes', 'SearchController@getRecipesPaginate');
Route::get('search/people', 'SearchController@getUsersPaginate');
Route::get('search/categories', 'SearchController@getCategoriesPaginate');
// Route::get('search/groups', 'SearchController@getGroupsPaginate');
