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

Route::put('recipe/{recipeId}', [RecipeController::class, 'update']);
Route::post('recipe', 'RecipeController@insert');
Route::get('recipe/{recipe_id}', 'RecipeController@select');
Route::post('recipe/{recipe_id}', 'RecipeController@update');
Route::delete('recipe/{recipe_id}', 'RecipeController@delete');

Route::get('units', [UnitController::class, 'index']);
