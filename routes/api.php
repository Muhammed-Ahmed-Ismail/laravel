<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\PostController;
use \App\Http\Controllers\api\AuthenticationController;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::post('posts',[PostController::class,'store'])->name('posts.post');
    Route::delete('posts/{id}',[PostController::class,'delete'])->name('posts.post');
    Route::put('posts/{id}',[PostController::class,'update']);
    Route::get('posts',[PostController::class,'index'])->name('all.posts');
    Route::get('posts/{id}',[PostController::class,'show'])->name('posts.post');
});
Route::post('/sanctum/token',[AuthenticationController::class,'authenticate']);


