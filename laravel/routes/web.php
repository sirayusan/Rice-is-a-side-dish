<?php


use App\Http\Controllers\Controller;
use App\Http\Controllers\TopController;
use App\Http\Controllers\PostController;
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

//投稿関連
Route::get('/top',[TopController::class,'index']);
Route::get('/post/create',[PostController::class,'create']);
Route::post('/post',[PostController::class,'store']);

//認証機能
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ログアウト
Route::get('/logout',[PostController::class,'logout']);
