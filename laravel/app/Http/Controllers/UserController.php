<?php
namespace App\Http\Controllers;

use App\Http\Requests\ValidateController;
use App\Models\Post;
use App\Models\User;
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

    public function show($id)
    {
        if (Auth::check() === false )
        {
            return redirect('top');
        }

        $user = Auth::user();

        //default値の画像ディレクトリが違うのでパスを条件分岐しておく
        if ($user->image == "no_image.png")
        {
            $user_image_path =   asset("/SystemImage/no_image.png");
        }else{
            $user_image_path =   asset("/UserImage/$user->image");
        }

        $posts = User::find($user->id)->posts()->get();

        return view('profile',compact('user','posts','user_image_path'));
    }

    //ユーザー情報変更(画像・ユーザー名・自己紹介文)
    public function store(ValidateController $request)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->comment = $request['comment'];

        //formから画像ファイルの実態を受け取っていたら画像ファイル名取得し、保存する
        if (isset($request['image']))
        {
            $fileName = hash('sha256',time() . $request['image']->getClientOriginalName());
            $target_path = storage_path('app/public/image/UserImage');
            $request['image']->move($target_path, $fileName);
            $user->image = $fileName;
        }

        $user->update();

        return redirect('top');
    }
}
