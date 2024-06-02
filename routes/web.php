<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\StaticPagesController;





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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('post/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('new_comment/{post_id}', [CommentsController::class, 'create_comment'])->name('create_comment');
Route::get('load_more_comments/{post_id}', [CommentsController::class, 'load_more_comments'])->name('load_more_comments');
Route::get('about', [StaticPagesController::class, 'index'])->name('about_page');



Route::group(['prefix'=>'Admin'], function()
{
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('login', [AdminLoginController::class, 'index'])->name('login_get');
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout')->middleware('auth');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login_post');

    Route::resource('posts', PostsController::class);

    Route::get('about', [StaticPagesController::class, 'edit'])->name('view_edit_about')->middleware('auth');;
    Route::post('update_about', [StaticPagesController::class, 'update'])->name('edit_about')->middleware('auth');
    
    Route::get('delete_comment/{comment_id}', [CommentsController::class, 'destroy'])->name('delete_comment')->middleware('auth');
	Route::get('delete_all_comments/{post_id}', [CommentsController::class, 'destroy_all'])->name('delete_all_comments')->middleware('auth');

});