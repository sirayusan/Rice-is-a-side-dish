<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 投稿内容を入力するページVIEW(post.blade.php)を返す
     */
    public function create(Request $request)
    {
      //ログイン状態確認。未ログインであれば会員登録ページへ飛ばす（この対処は仮）
      $login_parameter = Auth::check();
      if ($login_parameter === false) {
          return view('auth/login');
      }
      return view('post',compact('login_parameter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * post.blade.phpのformから値を受け取りログインしていればバリデートし、DBに保存する
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

        //DBに保存したい値を配列化する
        $post_info = array(
            'comment' => $validatedData['comment'],
            'user_id' => Auth::id(),
        );

        //Postモデルのインスタンス化
        $post = new Post();
        //Postインスタンスに配列（$store_post_create）を入れ、DBに保存する。
        $post->fill($post_info)->save();

        //VIEWファイルと変数を返す。
        return view('post_complete',compact('post_info'));
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
