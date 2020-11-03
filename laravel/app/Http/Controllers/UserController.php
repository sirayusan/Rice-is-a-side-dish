<?php
namespace App\Http\Controllers;

use Auth;

class UserController extends Controller
{
    //ログアウト
    public function logout(){
        return Auth::logout();
    }

    public function __construct(){
        $this->middleware('auth');
    }
}
