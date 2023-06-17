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
    return view('welcome');
})->middleware('auth');
Route::get('/home', function () {
    return view('home');
});

Auth::routes();


Route::group([
    'middleware' => 'auth',
    ],function (){
    // Route::resource('/posts',PostController::class)->middleware(['admin','profil']);
    Route::get('/posts',[PostController::class,'index'])->name('posts.index')->middleware('auth');
    Route::post('/posts',[PostController::class,'store'])->name('posts.store')->middleware('auth');
    Route::get('/posts/create',[PostController::class,'create'])->name('posts.create')->middleware('auth');
    Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show')->middleware('auth');
    Route::delete('/posts/{post}',[PostController::class,'destroy'])->name('posts.destroy')->middleware('profil');
    Route::put('/posts/{post}',[PostController::class,'update'])->name('posts.update')->middleware('profil');
    Route::get('/posts/{post}/edit',[PostController::class,'edit'])->name('posts.edit')->middleware('profil');

    Route::get('/user-posts',[PostController::class,'userPosts'])->name('userPosts')->middleware('auth');
    Route::get('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('restoreall', [PostController::class, 'restoreAll'])->name('posts.restoreAll');
    // Route::get('posts/restore-all', [PostController::class, 'res'])->name('posts.resAll');

}

);
Route::get('admin',[AdminController::class,'getPosts'])->middleware('admin');
