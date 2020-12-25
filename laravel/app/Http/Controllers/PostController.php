<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Auth;
use File;
use Str;

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
             'comment' => ['max:255'],
             'title'   => ['required', 'max:255'],
         ]);

         $post = new Post();
         //画像はbase64で受け取っている。
         if(strpos($request->image,'data:image/png;base64') !== false){
             $image = base64_decode(str_replace(' ', '+',str_replace('data:image/png;base64,', '', $request->image)));
             $post->image = hash('sha256',Str::random(20).time()).'.'.'png';
             File::put(storage_path('app/public/image/PostImage'). '/' . $post->image, $image);
         }else{
             return back()->with('error', '画像が選択されていないか、画像以外が選択されています。');
         }
         $post->title = $validatedData['title'];
         $post->comment = $validatedData['comment'];
         $post->user_id = Auth::id();
         $post->save();

         //文字列をタグの形式に置換して、dbに保存する
         $substitute_tag = explode(',',str_replace('，',',',$request->tags));
         foreach ($substitute_tag as $comment) {
             if(isset($substitute_tag))
             {
                 $tag = new Tag;
                 $tag->tag = $comment;
                 $tag->post_id = User::find(Auth::id())->posts()->latest()->first()->id;
                 $tag->save();
             }
         }
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
        ]);

        $post = Post::find($id);
        //画像はbase64で受け取っている。
        if(strpos($request->image,'data:image/png;base64') !== false){
            $image = base64_decode(str_replace(' ', '+',str_replace('data:image/png;base64,', '', $request->image)));
            $post->image = hash('sha256',Str::random(20).time()).'.'.'png';
            File::put(storage_path('app/public/image/PostImage'). '/' . $post->image, $image);
        }else{
            return back()->with('error', '選択できるのは画像のみです。');
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
       return redirect()->back();
   }
}
