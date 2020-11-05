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
  <a href="../post/create">投稿する</a>
  <br>
  <!-- postメソッドで移動させるためにformでpost指定 -->
  <form method="post" name="form_1" id="form_1" action="/user/logout">
      <input type="hidden" name="user_name" placeholder="ユーザー名">
      <a href="javascript:form_1.submit()">ログアウト</a>
  <p>投稿一覧表示</p>
  @foreach ($posts as $post)
    <div class="post">
      <p>user_id</p>
      <p>{{ $post{'user_id'} }}</p>
      <p>投稿内容</p>
      <p>{{ $post['comment'] }}</p>
    </div>
  @endforeach
  </body>
</html>
