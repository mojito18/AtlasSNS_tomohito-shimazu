@extends('layouts.logout')

@section('content')
<!--登録したユーザ名表示-->
<div id="clear">
  <p class="nowUser">{{ session('username') }}さん</p>
  <p class="title1">ようこそ！AtlasSNSへ！</p>
  <p class="title2">ユーザー登録が完了しました。</p>
  <p class="title3">早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
