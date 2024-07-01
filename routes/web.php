<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GuestController;

Route::middleware('guest')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('welcome');
    Route::get('/filter/{filter}', [GuestController::class, 'index'])->name('welcome.filter');
    Route::get('/guestShow/{blog}', [GuestController::class, 'guestShow'])->name('guestShow');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //dashboard
    Route::get('/dashboard', [HomePageController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/sort/{filter}', [HomePageController::class, 'index'])->name('dashboard.sort');


    //liked Posts page 
    Route::get('/likedPosts', [LikeController::class, 'likedPosts'])->name('likedPosts');


    //my Blogs
    Route::get('myBlogs', [BlogController::class, 'myBlogs'])->name('myBlogs');
    Route::get('myBlogs/sort/{filter}', [BlogController::class, 'myBlogs'])->name('myBlogs.sort');

    Route::get('myBlogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('myBlogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('myBlogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('myBlogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('myBlogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    //Individual blogs
    Route::get('show/{blog}', [HomePageController::class, 'show'])->name('show');
    Route::post('blogs/{blog}/like', [LikeController::class, 'store'])->name('blogs.like');
    Route::delete('blogs/{blog}/like', [LikeController::class, 'destroy'])->name('blogs.unlike');
    Route::post('blogs/{blog}/comment', [CommentController::class, 'store'])->name('blogs.comment');

});
