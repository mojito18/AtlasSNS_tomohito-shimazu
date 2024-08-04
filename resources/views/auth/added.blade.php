@extends('layouts.logout')

@section('content')
<!--登録したユーザ名表示-->
<div id="clear">
  <p>{{ session('username') }}</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
