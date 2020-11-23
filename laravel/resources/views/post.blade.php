
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
    <div class="wrap"></div>
    <h1>ポスト作成</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- gloval_fixed_menuの初位置を確保すためのタグ -->
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
       @csrf
      <dt><label for="comment">画像説明文</label></dt>
      <dd><textarea name="comment" rows="4" cols="40"></textarea></dd>
      <dt><label for="image">画像変更</label></dt>
      <dd><input type="file" name="image" value=""></dd>
      <input type="submit" value="投稿する" >
    </form>
    <a href="{{ route('top.index') }}">トップへ</a>
  </body>
</html>
