<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->middleware('auth');

Auth::routes();


Route::group([
    'middleware' => 'auth',
    ],function (){
    Route::get('/posts',[PostController::class,'index'])->name('posts.index')->middleware('admin');
    Route::POST('/posts/delet/{id}',[PostController::class,'destroy'])->name('posts.destroy');
    Route::get('/posts/{id}/edit',[PostController::class,'edit'])->name('posts.edit');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create');
    Route::post('/posts/store',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/show/{id}',[PostController::class,'show'])->name('posts.show');
    Route::post('/posts/update/{id}',[PostController::class,'update'])->name('posts.update');

    Route::get('/user-posts',[PostController::class,'userPosts'])->name('userPosts')->middleware('auth');
    Route::get('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('/posts/restore-all', [PostController::class, 'restoreAll'])->name('posts.restoreAll');

}

);
Route::get('admin',[AdminController::class,'getPosts'])->middleware('admin');
