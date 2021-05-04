<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UnitController;
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

Route::put('recipe/{recipeId}', [RecipeController::class, 'update']);
Route::post('recipe', 'RecipeController@insert');
Route::get('recipe/{recipe_id}', 'RecipeController@select');
Route::post('recipe/{recipe_id}', 'RecipeController@update');
Route::delete('recipe/{recipe_id}', 'RecipeController@delete');

Route::get('units', [UnitController::class, 'index']);

Route::post('recipe/{recipeId}/favourite', 'RecipeController@addToFavourites');
Route::delete('recipe/{recipeId}/favourite', 'RecipeController@removeFromFavourites');

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
