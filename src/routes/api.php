<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SearchController;
use App\Http\Middleware\IsAdmin;
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
Route::middleware('auth:api')->get('user', 'Auth\LoginController@getUser');

// ----------------------------------------------------------------
// User API
// ----------------------------------------------------------------
Route::post('user', 'MemberController@post')->middleware('can:create,user');
Route::put('user/{user}', 'MemberController@put')->middleware('can:update,user');
Route::delete('user/{user}', 'MemberController@deleteAction')->middleware('can:delete,user');
Route::get('user/{user}', 'MemberController@get');
Route::get('user/{user}/recipes', 'MemberController@getRecipes')->middleware('can:view,user');
Route::get('user/{user}/reviews', 'MemberController@getReviews')->middleware('can:view,user');
Route::get('user/{user}/favourites', 'MemberController@getFavourites')->middleware('can:view,user');
Route::get('user/{user}/following', 'MemberController@getFollowing')->middleware('can:view,user');
Route::get('user/{user}/followers', 'MemberController@getFollowers')->middleware('can:view,user');
Route::get('user/{user}/groups', 'MemberController@getGroups')->middleware('can:view,user');
Route::get('users', 'MemberController@index');
Route::post('user/{user}/request', 'MemberController@followRequest')->middleware('can:follow,user');
Route::delete('user/{user}/request', 'MemberController@deleteFollowRequest')->middleware('can:deleteFollow,user');
Route::put('user/request/{user}', 'MemberController@acceptFollowRequest')->middleware('can:acceptOrDeclineFollow,user');
Route::delete('user/request/{user}', 'MemberController@declineFollowRequest')->middleware('can:acceptOrDeclineFollow,user');
Route::put('user/{user}/ban', 'MemberController@banUser')->middleware('IsAdmin');

// ----------------------------------------------------------------
// Recipe API
// ----------------------------------------------------------------
Route::post('recipe', 'RecipeController@insert')->middleware('can:insert,App\Models\Recipe');
Route::get('recipe/{recipe}', 'RecipeController@select')->middleware('can:select,recipe');
Route::put('recipe/{recipe}', 'RecipeController@update')->middleware('can:update,recipe');
Route::delete('recipe/{recipe}', 'RecipeController@delete')->middleware('can:delete,recipe');
Route::post('recipe/{recipe}/favourite', 'RecipeController@addToFavourites')->middleware('can:addToFavourites,recipe');
Route::delete('recipe/{recipe}/favourite', 'RecipeController@removeFromFavourites')->middleware('can:removeFromFavourites,recipe');
Route::post('recipe/{recipe}/report', 'RecipeController@report');

// ----------------------------------------------------------------
// Group API
// ----------------------------------------------------------------
Route::post('group', 'GroupController@post')->middleware('can:create,App\Models\Group');
Route::put('group/{group}', 'GroupController@put')->middleware('can:update,group');
Route::delete('group/{group}', 'GroupController@remove')->middleware('can:delete,group');
Route::get('group/{group}', 'GroupController@get');
Route::post('group/{group}/request', 'GroupController@request')->middleware('can:join,group');
Route::delete('group/{group}/request', 'GroupController@cancelRequest')->middleware('can:removeRequest,group');
Route::post('group/{group}/request/{user}', 'GroupController@accept')->middleware('can:update,group');
Route::delete('group/{group}/request/{user}', 'GroupController@decline')->middleware('can:update,group');
Route::post('group/{group}/moderator/{user}', 'GroupController@addModerator')->middleware('can:update,group');
Route::delete('group/{group}/member/{user}', 'GroupController@removeMember')->middleware('can:removeUser,group,user');
Route::get('group/{group}/members', 'GroupController@getMembers')->middleware('can:view,group');

// ----------------------------------------------------------------
// List API
// ----------------------------------------------------------------
Route::get('feed', 'FeedController@get');
Route::get('feed/load_more', 'FeedController@getMoreRecipes');
Route::get('search/recipes', 'SearchController@getRecipesPaginate');
Route::get('search/people', 'SearchController@getUsersPaginate');
Route::get('search/categories', 'SearchController@getCategoriesPaginate');
Route::get('search/groups', 'SearchController@getGroupsPaginate');

// ----------------------------------------------------------------
// Chat API
// ----------------------------------------------------------------
Route::get('chat/{user}', 'ChatController@get');
Route::post('chat/{user}', 'ChatController@post');
Route::get('chats', 'ChatController@index');

// ----------------------------------------------------------------
// Report API
// ----------------------------------------------------------------
Route::get('reports', 'ReportController@index');
Route::delete('report/{report}', 'ReportController@delete');

// ----------------------------------------------------------------
// Notifications API
// ----------------------------------------------------------------
Route::get('notifications', 'NotificationsController@get');
Route::put('notifications', 'NotificationsController@put');

// ----------------------------------------------------------------
// Comment API
// ----------------------------------------------------------------
Route::post('comment', 'CommentController@insert')->middleware('can:create,App\Models\Comment');
Route::put('comment/{comment}', 'CommentController@put')->middleware('can:update,comment');
Route::delete('comment/{comment}', 'CommentController@remove')->middleware('can:delete,comment');
Route::post('comment/{comment}/report', 'CommentController@report');

// ----------------------------------------------------------------
// Information API
// ----------------------------------------------------------------
Route::get('countries', 'CountryController@index');
Route::get('categories', 'CategoryController@index');
Route::get('tags', 'TagController@index');
Route::get('ingredients', 'IngredientController@index');
Route::get('units', 'UnitController@index');
