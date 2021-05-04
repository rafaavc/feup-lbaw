<?php

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

Route::post('recipe', 'RecipeController@insert')->middleware('can:insert,App\Models\Recipe');
Route::get('recipe/{recipe}', 'RecipeController@select')->middleware('can:select,recipe');
Route::put('recipe/{recipe}', 'RecipeController@update')->middleware('can:update,recipe');
Route::delete('recipe/{recipe}', 'RecipeController@delete')->middleware('can:delete,recipe');

Route::get('units', 'UnitController@index');

Route::post('recipe/{recipe}/favourite', 'RecipeController@addToFavourites')->middleware('can:addToFavourites,recipe');
Route::delete('recipe/{recipe}/favourite', 'RecipeController@removeFromFavourites')->middleware('can:removeFromFavourites,recipe');

Route::post('comment', 'CommentController@insert')->middleware('can:insert,App\Models\Comment');
