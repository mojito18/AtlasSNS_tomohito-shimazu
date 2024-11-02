@extends('layouts.login')

@section('content')
<!-- 適切なURLを入力してください -->

<form action="/profile/update" method="post" enctype="multipart/form-data"><!--フォームタグは全体を選択（シンボリくリンク追加）-->
  @method('PUT')
  @csrf

<p>プロフィール</p>
  <div class=>ユーザー名
    <input type="text" name="username" value="{{ Auth::user()->username}}">
      <img src="{{ asset('storage/images/' . Auth::user()->images) }}" ><!--ログインしているオースから持ってくる-->

    </div>

<div class=>メールアドレス
  <input type="text" name="mail" value="{{Auth::user()->mail}}">
</div>

<div class=>パスワード
  <input type="text" name="password">
</div>

<div class=>パスワード確認
  <input type="password" name="password_confirmation" value="">
</div>

<div class=>自己紹介
  <input type="text" name="bio" value="{{Auth::user()->bio}}">
</div>

<div class=>アイコン画像
  <input type="file" name="profile_image" value=""><a><img src="asset('images/' . Auth::user()->images)" ></a>
</div>

<!--9/26　更新-->
  <button type="submit">更新</button>
</form>
@endsection
