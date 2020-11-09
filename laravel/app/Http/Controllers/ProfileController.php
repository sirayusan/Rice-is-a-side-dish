<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateController;
use Illuminate \ Support \ Facades \ Validator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    //プロフィールページに必要な値を渡してVIEWファイルを呼び出す
    public function index()
    {
        //ログインしていなかったらTOPにリダイレクトする。
        if (Auth::check() === false )
        {
            return redirect('top');
        }

        //ユーザーモデルのインスタンス化
        $user = new User;

        //Auth::id()をもとにアカウントDBから1件情報を取得
        $datas = $user->where('id',Auth::id())->first();

        //メアドを加工する
        $mail = substr($datas['email'], 0, 4).'***@****';

        //必要な情報を配列にする
        $data = array(
          'name'    => $datas['name'],
          'mail'    => $mail,
          'image'   => $datas['image'],
          'comment' => $datas['comment']
        );

        $post = new Post;
        $get_posts = $post->where('user_id',Auth::id())->get();

        return view('profile',compact('data','get_posts'));
    }

    //ユーザー情報変更(画像・ユーザー名・自己紹介文)
    public function store(ValidateController $request)
    {
        // $rules = [
        //            'name'        => 'nullable|max: 30',
        //            'email'       => 'nullable|max: 1000'
        //            'comment'     => 'nullable|max: 1000',
        //            'profile_img' => 'nullable|image|file',
        //        ];
        //
        // $validated = $this->validate($request, $rules);
        // dd(var_dump($validated));

        //Postモデルのインスタンス化
        $user = new User;
        //Auth::id()をもとにアカウントDBから1件情報を取得
        $datas = $user->where('id',Auth::id())->first();

        //メアドがNULLだとUPDATE時にエラーがでるので、フォームから受け取っていなかった場合、保存されているメアドを格納する
        if (isset($request['email']) === true )
        {
            $mail = $request['email'];
        } else {
            $mail = $datas['email'];
        }

        //フォームから画像ファイルの実態を受け取っていたら画像ファイル名取得し、保存する。受け取っていない場合はDBから取得していた画像ファイル名を宣言する。。
        if (isset($request['image']) === true)
        {
            //タイムスタンプとファイル名を文字列結合し,hash化した上でファイルの命名
            $fileName = hash('sha256',time() . $request['image']->getClientOriginalName());
            //ファイル保管場所宣言
            $target_path = public_path('img/user');
            //ファイルを保存する
            $request['image']->move($target_path, $fileName);
        } else {
            $fileName = $datas['image'];
        }

        //DBに保存したい値を配列化する
        $user_info = array(
            'name'    => $request['name'],
            'comment' => $request['comment'],
            'image'   => $fileName,
            'email'    => $mail
        );

        //Postインスタンスに配列（$store_post_create）を入れ、DBに保存する。
        $user->where('id', Auth::id())->update($user_info);
        return redirect('top');
    }
}
