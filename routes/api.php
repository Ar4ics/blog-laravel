<?php

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

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');


Route::resource('posts', 'PostController');
Route::post('comment/{id}', 'PostController@storeComment');
Route::get('tags', 'TagController@index');
Route::get('tags/{tag}', 'TagController@show');
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user}/posts', 'UserController@showPosts');
Route::get('users', 'UserController@index');


Route::get('profile', 'UserController@profile');

Route::post('users/{id}', 'UserController@store');

Route::post('login', 'AuthController@login');

Route::post('register', 'AuthController@register');

Route::get('params', function () {
    return [
        'count_posts' => App\Article::get()->count(),
        'count_tags' => App\Tag::get()->count(),
        'count_comments'=> App\Comment::all()->count()
    ];
});