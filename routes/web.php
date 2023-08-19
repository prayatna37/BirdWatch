<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('landing');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Add Post View
Route::get('/addposts', [App\Http\Controllers\PostsController::class, 'index'])->name('post.view');
Route::post('/createpost', [App\Http\Controllers\PostsController::class, 'store'])->name('post.create');


//Showing User Profile
Route::get('/profile/{user_id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.view');

Route::post('/profile/edit/{user_id}', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::delete('/post/destroy/{post_id}', [App\Http\Controllers\PostsController::class, 'destroy'])->name('profile.delete');
