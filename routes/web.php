<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use \App\Http\Controllers\AjaxController;

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
Route::group(['middleware'=>'auth'],function(){

    Route::get('/',[PostController::class,'index'] );
    Route::post('/ajaxView',[PostController::class,'viewAjax'])->name('ajax.post');
    Route::delete('/posts/delete',[PostController::class,'delete'])->name('posts.delete');
    Route::post('/posts/pruneold',[PostController::class,'pruneOldPosts'])->name('posts.prune');
    Route::get('/posts',[PostController::class,'index'])->name('posts.index');
    Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/delete/confirm/{id}',[PostController::class,'confirmDelete'])->name('posts.confirmDelete');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{post}',[PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/update/{id}',[PostController::class,'update'])->name('posts.update');
    Route::delete('/posts/delete/{id}',[PostController::class,'delete'])->name('posts.delete');
    Route::put('/posts/retrieve/{id}',[PostController::class,'retrieve'])->name('posts.retrieve');
    Route::post('/posts/comment/add',[CommentController::class,'create'])->name('comments.create');
    Route::delete('/posts/comment/delete',[CommentController::class,'delete'])->name('comments.delete');
    Route::put('/posts/comments/retrieve',[CommentController::class,'retrieve'])->name('comments.retrieve');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

});


Route::post('/ajax', [AjaxController::class,'send_http_request'])->name('ajaxRequest.post');
Route::get('/ajax', [AjaxController::class,'view']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
