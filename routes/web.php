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
use App\User;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

// ** Route group for middlewares
Route::group(['middleware'=>'admin'], function() {

    Route::get('/admin', function() {
        return view('admin.index');
    });
    //** Resource will create routes for you:
    Route::resource('/admin/users', 'AdminUsersController');
    Route::resource('/admin/posts', 'AdminPostsController');
    Route::resource('/admin/categories', 'AdminCategoriesController');
    Route::resource('/admin/media', 'AdminMediaController');
    // How to create your own connection to controller:
    // Route::get('/admin/media/upload', ['as'=>'media.upload', 'uses'=>'AdminMediaController@store']);
    Route::resource('/admin/comments', 'PostCommentsController');
    Route::resource('/admin/comment/replies', 'CommentRepliesController');

});    

