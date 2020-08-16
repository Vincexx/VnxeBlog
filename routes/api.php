<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Post;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->resource('categories', 'api\CategoriesController');

Route::get('category/{category}/posts', 'api\CategoriesController@categoryPosts');

Route::middleware('auth:api')->resource('posts', 'api\PostsController');
Route::middleware('auth:api')->resource('users', 'api\UsersController');

Route::middleware('auth:api')->resource('account', 'api\AccountController');

Route::resource('users', 'api\UsersController');
Route::middleware('auth:api')->resource('profile', 'api\ProfileController');



