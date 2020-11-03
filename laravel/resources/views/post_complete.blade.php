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
    <p>以下の内容で投稿完了しました</p>
    <br>
    <p>user_id</p>
    <p>{{ $post_info['user_id'] }}</p>
    <br>
    <p>投稿内容</p>
    <p>{{ $post_info['comment'] }}</p>
    <br>
    <a href="../top">トップページヘ戻る</a>
  </body>
</html>
