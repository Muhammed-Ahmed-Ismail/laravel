<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});
Route::delete('/posts/delete',[PostController::class,'delete'])->name('posts.delete');

Route::get('/posts',[PostController::class,'index'])->name('posts.index');
Route::get('/posts/create/', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/delete/confirm/{id}',[PostController::class,'confirmDelete'])->name('posts.confirmDelete');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post}/edit',[PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/update',[PostController::class,'update'])->name('posts.update');
Route::delete('/posts/delete/{id}',[PostController::class,'delete'])->name('posts.delete');
Route::put('/posts/retrieve/{id}',[PostController::class,'retrieve'])->name('posts.retrieve');
Route::post('/posts/comment/add',[PostController::class,'addComment'])->name('posts.addComment');
