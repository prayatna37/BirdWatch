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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Add Post View
Route::get('/addposts', [App\Http\Controllers\PostsController::class, 'index'])->name('post.view');

Route::post('/createpost', [App\Http\Controllers\PostsController::class, 'store'])->name('post.create');
