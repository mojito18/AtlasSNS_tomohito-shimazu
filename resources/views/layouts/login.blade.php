<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title></title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->
</head>

<body>
  <header>
    <div id="head">
      <h1><a href='/top'><img src="/images/atlas.png" alt="プロフィール画像"></a></h1>
      <!--アコーディオン記載場所-->
      <div id=" accordion" class="accordion_container">
        <div class="accordion-title js-accordion-title">
          <!--更新の画像-->
          <p>{{ Auth::user()->username }}さん<img src="{{asset('/storage/images/'.Auth::user()->images)}}" alt="プロフィール画像"></p>
          <a href="#" class="menu-btn">ボタン</a>
        </div>
        <ul class="menu">
          <!--アコーディオン設定箇所-->
          <li><a class='home' href="/top">ホーム</a></li>
          <li><a class='profile' href="/profile">プロフィール編集</a></li>
          <li><a class='logout' href="/logout">ログアウト</a></li>
        </ul>
      </div>
    </div>
  </header>
  <div id="row">
    <div id="container">
      @yield('content')
    </div>
    <div id="side-bar">
      <div id="confirm">
        <div class="infoBar">
          <p class="loginUser">{{ Auth::user()->username }}さんの</p>
          <div class="following">
            <p>フォロー数</p>
            <p>{{ Auth::user()->followingCount() }}人</p>
          </div>
          <p class="followBtn"><a href="/follow-list">フォローリスト</a></p>
          <div class="follower">
            <p>フォロワー数</p>
            <p>{{ Auth::user()->followersCount() }}人</p>
          </div>
          <p class="followerBtn"><a href="/follower-list">フォロワーリスト</a></p>
        </div>
      </div>
      <div class="searchClass">
        <p class="searchBtn"><a href="/search">ユーザー検索</a></p>
      </div>
    </div>
  </div>
  </div>
  <footer>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/script.js"></script>
</body>

</html>
