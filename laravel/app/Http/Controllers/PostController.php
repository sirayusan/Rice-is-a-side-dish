<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use DateTime;
use Auth;

class PostController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function logout(){
      return Auth::logout();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 投稿内容を入力するページVIEW(post.blade.php)を返す
     */
    public function create(Request $request)
    {
      return view('post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * post.blade.phpのformから値を受け取りDBに保存する
     * 戻り値
     * post_complete.blade.php
     * $store_post_create
     */
    public function store(Request $request)
    {
      //$requestのバリデート
      $validatedData = $request->validate([
        'comment' => ['required', 'unique:posts', 'max:255'],
      ]);

      //日付情報取得
      //形式はy-m-d
      $now = new DateTime();
      $now->format('Y-m-d');

      //DBに保存したい値を配列化する
      $store_post_create= array(
        'comment' => $validatedData['comment'],
        'user_id' => Auth::id(),
        'created_at' => $now
      );

      //Postモデルのインスタンス化
      $post = new Post();
      //054 Unknown column 'updated_at' in 'field listと怒られてしまったので仕方なくここでも明示することにする
      //Model/Postの方にも書いてあるんだけどなぁ。。。。。
      $post->timestamps = false;
      //Postインスタンスに配列（$store_post_create）を入れ、DBに保存する。
      $post->fill($store_post_create)->save();

      //VIEWファイルと変数を返す。
      return view('post_complete',compact('store_post_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
