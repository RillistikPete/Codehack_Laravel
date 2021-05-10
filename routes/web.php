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
use \Unisharp\LaravelFilemanager;
// use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//email
Route::get('/useremail', 'UserEmailController@index')->name('mail');
Route::post('/useremail/send', 'UserEmailController@send');

Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'HomeController@post']);
Route::get('/categ-posts/{id}', ['as'=>'home.categ-posts', 'uses'=>'HomeController@categPosts']);

//get create post page for non-admin users: (taken out for now)
//Route::get('post', 'HomeController@userCreatePost')->name('user-create-post');

// ** Route group for middlewares
Route::group(['middleware'=>'admin'], function() {

    Route::get('/admin', 'AdminController@index');

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
// For delete method checkboxes on media index
Route::delete('/delete/media', 'AdminMediaController@deleteMedia');

Route::group(['middleware'=>'auth'], function(){

    //Route::post('post', 'HomeController@store');
    Route::post('comment/reply', 'CommentRepliesController@createReply');
    Route::post('comment', 'PostCommentsController@store');
});

//Route::post('post', 'HomeController@store');

//Laravel file-manager alpha-version only - route group to wrap package routes:
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });
