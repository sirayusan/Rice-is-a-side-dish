<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class TopController extends Controller
{
    public function index()
    {
        // Frameworksモデルのインスタンス化
        $md = new Post();

        // 全データ取得
        $posts = $md->get();

        // ビューを返す
        return view('top',compact('posts'));
    }
}
