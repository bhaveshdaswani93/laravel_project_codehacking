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
use \Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@index');

// Route::auth();
Auth::routes();
Route::get('/logout','Auth\LoginController@logout');

Route::get('/home', 'HomeController@index');
Route::get('/post/{id}',['as'=>'home.post','uses'=>'HomeController@post']);
Route::group(['middleware'=>'admin','as'=>'admin.'],function(){
    Route::get('/admin', 'AdminController@index');
    Route::post('admin/med/delete',[
        'as' => 'med.delete',
        'uses'=>'AdminMediaController@deleteMedia'
    ]);
    // Route::post('/admin/media/delete',function(){
    //     return "route reached";
    // });
    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts','AdminPostsController');
    Route::resource('admin/categories','AdminCategoriesController');
    Route::resource('admin/media','AdminMediaController');
    // Route::get('/admin/media/upload',[
    //     'as' => 'admin.media.upload',
    //     'uses'=>'AdminMediaController@upload'
    // ]);
    Route::resource('admin/comments', 'PostCommentsController');
    Route::resource('admin/comment/replies', 'CommentRepliesController',['names'=>[
        'index' => 'comment.replies.index',
        'create' => 'comment.replies.create',
        'store' => 'comment.replies.store',
        'show' => 'comment.replies.show',
        'edit' => 'comment.replies.edit',
        'update' => 'comment.replies.update',
        'destroy' => 'comment.replies.destroy'
    ]]);
});

Route::group(['middleware'=>'auth'], function () {
    Route::post('/comment/reply','CommentRepliesController@storeReply');
});