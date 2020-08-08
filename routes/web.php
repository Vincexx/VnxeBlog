<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Post;

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

Route::get('/', function () {
    $recentPosts=Post::orderBy('updated_at','desc')->limit(3)->get();
    return view('welcome')->with('recentPosts', $recentPosts);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin-dashboard');

Route::middleware('auth')->get('admin/{any}', function () {
    return view('admin.dashboard');
})->where('any', '[\/\w\.-]*');

Route::post('logout', function() {

    return auth()->logout();

});

Route::resource('posts', 'PostsController');

Route::get('user/posts', function () {

    $user_posts = Auth::user()->posts;
    return response()->json($user_posts);

});
