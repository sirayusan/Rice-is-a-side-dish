<?php
namespace App\Http\Controllers;

use App\Http\Requests\ValidateController;
use App\Models\Post;
use App \Models\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //ログアウト
    public function user_logout() {
       return Auth::logout();
    }

    public function __construct(){
        $this->middleware('auth');
    }

    //プロフィールページに必要な値を渡してVIEWファイルを呼び出す
    public function index()
    {
        //ログインしていなかったらTOPにリダイレクトする。
        if (Auth::check() === false )
        {
            return redirect('top');
        }

        //プロフィールページで扱うために必要な情報をuserに代入する
        $user = Auth::user();

        //userのimageがno_image.pngの場合システム用のディレクトリパスを返す。違う場合、ユーザーディレクトリパスを返す
        if ($user->image == "no_image.png")
        {
          $user_image_path = storage_path("app/public/image/SystemImage");
        }else{
          $user_image_path = storage_path("app/public/image/UserImage");
        }

        // dd($user_image_path.$user->image);

        $posts = User::find(1)->get_post()->where('user_id',Auth::id())->get();

        return view('profile',compact('user','posts','user_image_path'));
    }

    //ユーザー情報変更(画像・ユーザー名・自己紹介文)
    public function store(ValidateController $request)
    {
        //プロフィールページで扱うために必要な情報をuserに代入する
        $user = Auth::user();

        //formからコメントを受け取っていたらインスタンスを上書きする
        if (isset($request['name']) === true )
        {
          $user->name = $request['name'];
        }

        //formからコメントを受け取っていたらインスタンスを上書きする
        if (isset($request['comment']) === true )
        {
          $user->comment = $request['comment'];
        }

        //formから画像ファイルの実態を受け取っていたら画像ファイル名取得し、保存する。受け取っていない場合はDBから取得していた画像ファイル名を宣言する。。
        if (isset($request['image']) === true)
        {
          //タイムスタンプとファイル名を文字列結合し,hash化した上でファイルの命名
          $fileName = hash('sha256',time() . $request['image']->getClientOriginalName());
          //ファイル保管場所宣言
          $target_path = storage_path('app/public/image/UserImage');
          //ファイルを保存する
          $request['image']->move($target_path, $fileName);
        }

        //formからメアドを受け取っていたらインスタンスを上書きする
        if (isset($request['email']) === true )
        {
            $user->email = $request['email'];
        }

        //会員情報を更新する
        $user->update();

        //処理後リダイレクトさせる
        return redirect('top');
    }
}
