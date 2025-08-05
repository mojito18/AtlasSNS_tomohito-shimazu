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
      <h1><a href='/top'><img src="/images/atlas.png" class="headImg" alt="プロフィール画像"></a></h1>
      <!--アコーディオン記載場所-->
      <div id="accordion" class="accordion_container">
        <div class="accordion-title js-accordion-title">
          <p>
            {{ Auth::user()->username }}さん <span id="toggleArrow" class="arrow-icon">
              <svg id="arrowSvg" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path d="M6 9l6 6 6-6" fill="none" stroke="#333" stroke-width="2" />
              </svg>
            </span>
            <!--画像登録ができななかった場合にデフォルト画像を準備-->
            @if (Auth::user()->images && Auth::user()->images !== 'icon1.png')
            <img src="{{asset('/storage/images/'.Auth::user()->images)}}" alt="プロフィール画像" width="30" height="30">
            @else
            <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" width="30" height="30">
            @endif
          </p>
        </div>
        <ul class="menu js-accordion-content">
          <li><a class='accordion-text' href="/top">HOME</a></li>
          <li class="highlight-menu-item"><a class='accordion-text' href="/profile">プロフィール編集</a></li>
          <li><a class='accordion-text' href="/logout">ログアウト</a></li>
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
            <p style="letter-spacing: -2px;">フォロワー数</p>
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
  <script src="/js/script.js"></script>
</body>

</html>
