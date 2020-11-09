<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>トップページ</title>
    <!-- スタイルを明示的にすべてリセットする -->
    <link href="../css/reset.css" rel="stylesheet" />
    <!-- スタイル指定 -->
    <link href="../css/style.css" rel="stylesheet" />
  </head>
  <body>
    <header id="sample">
      <nav id="gloval_fixed_menu">
        <ul id="gloval_fixed_menu_outer">
          <ul class="gnav gloval_fixed_menu_inner">
            <li>
            <a href="">Menu1</a>
            <ul>
              <li><a href="../home">会員登録はこちら</a></li>
              <li><a href="../home">会員登録はこちら</a></li>
              <li><a href="../home">会員登録はこちら</a></li>
            </ul>
            </li>
          </ul>
          <li class="gloval_fixed_menu_inner"><a href="../home">会員登録はこちら</a></li>
          <li class="gloval_fixed_menu_inner"><a href="../home">会員登録はこちら</a></li>
          <li class="gloval_fixed_menu_inner"><a href="../home">会員登録はこちら</a></li>
        </ul>
      </nav>
    </header>
    <!-- gloval_fixed_menuの初位置を確保すためのタグ -->
    <div class="wrap"></div>
    <h1>プロフィール</h1>
    <a href="../post/create">投稿する</a>
    <br>
    <!-- postメソッドで移動させるためにformでpost指定 -->
    <form method="post" name="form_1" id="form_1" action="/user/logout">
        <input type="hidden" name="user_name" placeholder="ユーザー名">
        <a href="javascript:form_1.submit()">ログアウト</a>
    </form>
    <a href="../top">トップへ</a>
    <form action="/profile" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="">
        <br>
        <p>アイコン</p>
        <img class="logo" src="{{ asset('/img/user/'.$data['image']) }}" alt="logo" width="80px">
        <br>
        <label for="image">画像変更</label>
        <input type="file" name="image" value="">
        <br>
        <label for="name">名前</label>
        <input type="text" name="name" value="{{ $data['name'] }}">
        <br>
        <p>メールアドレス    一部のみ表示しています。</p>
        <p>{{ $data['mail'] }}</p>
        <br>
        <p>自己紹介文</p>
        <input type="text" name="comment" value="{{ $data['comment'] }}">
        <br>
        <input type="submit" value="送信">
      </div>
    </form>
    <p>投稿一覧</p>
    @foreach ($get_posts as $get_post)
      <div class="post">
        <p>投稿内容</p>
        <p>{{ $get_post['comment'] }}</p>
      </div>
    @endforeach
  </body>
</html>
