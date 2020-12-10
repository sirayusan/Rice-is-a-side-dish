<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>トップページ</title>
    <!-- スタイルを明示的にすべてリセットする -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet" />
    <!-- スタイル指定 -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  </head>
  <body>
    <header id="sample">
      <nav id="gloval_fixed_menu">
        <ul id="gloval_fixed_menu_outer">
          <ul class="gnav gloval_fixed_menu_inner">
            <li>
            <a href="">Menu1</a>
            <ul>
              <li><a href="{{ route('home') }}">会員登録はこちら</a></li>
              <li><a href="{{ route('home') }}">会員登録はこちら</a></li>
              <li><a href="{{ route('home') }}">会員登録はこちら</a></li>
            </ul>
            </li>
          </ul>
          <li class="gloval_fixed_menu_inner"><a href="{{ route('home') }}">会員登録はこちら</a></li>
          <li class="gloval_fixed_menu_inner"><a href="{{ route('home') }}">会員登録はこちら</a></li>
          <li class="gloval_fixed_menu_inner"><a href="{{ route('home') }}">会員登録はこちら</a></li>
        </ul>
      </nav>
    </header>
  <!-- gloval_fixed_menuの初位置を確保すためのタグ -->
  <div class="wrap"></div>
  <a href="{{ route('top.index') }}">トップへ</a>
  <br>
  <p>投稿一覧表示</p>
    <div>
      <p>タイトル</p>
      <p>{{ $post->title }}</p>
      <p>投稿内容</p>
      <p>{{ $post['comment'] }}</p>
      @if ($post->image ==  "no_image.png")
      <p><img src="{{ asset('/SystemImage/no_image.png') }}" width="80px"></p>
      @else
      <p><img src="{{ asset("/PostImage/$post->image") }}" width="80px"></p>
      @endif
      <p>投稿者名</p>
      <p>{{ $post->user->name }}</p>
      @if ($follow->already_follow($post->user->id))
      <form action="{{ route('follows.destroy',['follow' => $follow->get_follow_id($post->user->id)]) }}" method="post">
        @method('DELETE')
        @csrf
        <input type="submit" value="フォロー解除">
      </form>
      @else
      <form action="{{ route('follows.store',['follow_user_id' => $post->user->id]) }}" method="post">
        @csrf
        <input type="submit" value="フォロー" >
      </form>
      @endif
    </div>
    <br>
    <div>
      <p>コメント表示</p>
      @foreach ($post->replies()->get() as $reply)
      <div class="replies">
        <p>投稿日</p>
        <p>{{ $reply->created_at }}</p>
        <p>投稿者</p>
        <p>{{ $reply->user->name }}</p>
        <p>コメント</p>
        <p>{{ $reply->comment }}</p>
      </div>
      @endforeach
    </div>
    @if ($post->already_favorite())
    <form action="{{ route('favorites.destroy',['post_id' => $post->id,'favorite'=>$post->get_favorite_id()]) }}" method="post">
      @method('DELETE')
      @csrf
      <input type="submit" value="いいね削除">
    </form>
    @else
    <form action="{{ route('favorites.store',['post_id' => $post->id]) }}" method="post">
      @csrf
      <input type="submit" value="いいね" >
    </form>
    @endif
    <div>
      <form action="{{ route('comments.store',['post_id' => $post->id]) }}" method="post" enctype="multipart/form-data">
         @csrf
         <p>コメントする</p>
        <dt><label for="reply">本文</label></dt>
        <dd><textarea name="reply" rows="4" cols="40"></textarea></dd>
        <input type="submit" value="送信" >
      </form>
    </div>
  </body>
</html>
