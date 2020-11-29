<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
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
      if (Auth::check() === false) {
          return view('auth/login');
      }
      return view('post');
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
        $validatedData = $request->validate([
            'comment' => ['required', 'max:255'],
            'image'   => ['image'],
        ]);

        $post = new Post();

        if (isset($request['image']))
        {
            $fileName = hash('sha256',time() . $request['image']->getClientOriginalName());
            $target_path = storage_path('app/public/image/PostImage');
            $request['image']->move($target_path, $fileName);
            $post->image = $fileName;
        }

        $post->comment = $validatedData['comment'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect('top');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
      $post = Post::find($id);
      return view('post_edit',compact('post'));
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
       //$requestのバリデート
       $validatedData = $request->validate([
           'comment' => ['required', 'max:255'],
           'image'   => ['image'],
       ]);

       $post = Post::find($id);
       if (isset($request['image']))
       {
         $fileName = hash('sha256',time() . $request['image']->getClientOriginalName());
         $target_path = storage_path('app/public/image/PostImage');
         $request['image']->move($target_path, $fileName);
         $post->image = $fileName;
       }
       $post->comment = $validatedData['comment'];
       $post->update();

       return redirect('top');
   }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   public function destroy($id)
   {
       Post::find($id)->delete();
       return redirect('top');
   }
}
