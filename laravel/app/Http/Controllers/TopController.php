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

    // データ取得
    $show_posts = $md->get_post();

    // ビューを返す
    return view('top',compact('show_posts'));
  }
}
