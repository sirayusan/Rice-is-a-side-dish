<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\TopController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

//topページ
Route::resource('top',TopController::class)->only([
    'index'
]);;

//投稿関連
Route::resource('post',PostController::class)->only([
    'create', 'store'
]);;

//認証機能
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログアウト
Route::post('/user/logout',[UserController::class,'user_logout'])->name('user_logout');
