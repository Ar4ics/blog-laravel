<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



//
//Route::resource('posts', 'PostController');
//Route::post('comment/{id}', 'PostController@storeComment');
//Route::get('tags', 'TagController@index');
//Route::get('tags/{tag}', 'TagController@show');
//Route::get('users/{user}', 'UserController@show');
//Route::post('users/avatar/{id}', 'UserController@storeAvatar');
//Route::post('users/info/{id}', 'UserController@storeInfo');
///*Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController'
//]);
//*/
//Route::get('/', function () {
//    return redirect('/posts');
//});
//Auth::routes();

Route::get('/{path?}', function($path = null){
    return view('layouts.app');
})->where('path', '.*');