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
    <h1>プロフィール</h1>
    <a href="{{ route('posts.create') }}">投稿する</a>
    <br>
    <a href="{{ route('top.index') }}">トップへ</a>
    <form action="/users" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	    @endif
      <div>
        <br>
        <p>アイコン</p>
        @if ($user->image ==  "no_image.png")
        <p><img src="{{ asset('/SystemImage/no_image.png') }}" width="80px"></p>
        @else
        <p><img src="{{ asset("/PostImage/$user->image") }}" width="80px"></p>
        @endif
        <br>
        <label for="image">画像変更</label>
        <input type="file" name="image" value="">
        <br>
        <label for="name">名前</label>
        <input type="text" name="name" value="{{ $user->name }}">
        <br>
        <p>メールアドレス    一部のみ表示しています。</p>
        <p>{{ substr($user->email, 0, 4)."***@****" }}</p>
        <br>
        <p>自己紹介文</p>
        <input type="text" name="comment" value="{{ $user->comment }}">
        <br>
        <input type="submit" value="送信">
      </div>
    </form>
    <div >
        <p>フォロー一覧</p>
        @foreach($user->follows as $follow)
            <div class="user">
                @if ($follow->user->image ==  "no_image.png")
                    <p><img src="{{ asset('/SystemImage/no_image.png') }}" width="80px"></p>
                @else
                    <p><img src="{{ asset("/PostImage/$follow->user->image") }}" width="80px"></p>
                @endif
                <p>{{ $follow->user->name  }}</p>
                <p>{{ $follow->user->comment  }}</p>
            </div>
        @endforeach
        <p>フォロワー一覧</p>
        @foreach($user->followers as $follower)
        <div class="user">
            @if ($follower->user->image ==  "no_image.png")
            <p><img src="{{ asset('/SystemImage/no_image.png') }}" width="80px"></p>
            @else
            <p><img src="{{ asset("/PostImage/$follow->user->image") }}" width="80px"></p>
            @endif
            <p>{{ $follower->user->name  }}</p>
            <p>{{ $follower->user->comment  }}</p>
        </div>
        @endforeach
    </div>
    <p>投稿一覧</p>
    @foreach ($user->posts as $post)
      <div class="post">
        <p>投稿内容</p>
        <p>{{ $post->comment }}</p>
        @if ($post->image ==  "no_image.png")
        <p><img src="{{ asset('/SystemImage/no_image.png') }}" width="80px"></p>
        @else
        <p><img src="{{ asset("/PostImage/$post->image") }}" width="80px"></p>
        @endif
        <form action="{{ route('posts.destroy',['post'=>$post->id]) }}" method="post">
          @method('DELETE')
          @csrf
          <input type="submit" value="削除">
        </form>
        <form action="{{ route('posts.edit',['post'=>$post->id]) }}" method="get">
          <input type="submit" value="編集">
        </form>
      </div>
    @endforeach
  </body>
</html>
