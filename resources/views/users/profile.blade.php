@extends('layouts.login')

@section('content')
<!-- 適切なURLを入力してください -->


<div class="profile-edit-container">
  <form action="/profile/update" method="post" enctype="multipart/form-data">
    @csrf

    <table class="profile-table" style="margin: 0 auto;">

      <tr>
        <!-- アイコンセル -->
        <td style="width:70px; text-align:center; vertical-align: middle;">
          <img class="profile-image" src="{{ asset('/storage/images/' . Auth::user()->images) }}" alt="プロフィール画像" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
        </td>
      </tr>
      <th align="left"><label for="username">ユーザー名</label></th>
      <td><input type="text" name="username" value="{{ Auth::user()->username }}"></td>
      </tr>

      <tr>
        <th align="left"><label for="mail">メールアドレス</label></th>
        <td><input type="text" name="mail" value="{{ Auth::user()->mail }}"></td>
      </tr>

      <tr>
        <th align="left"><label for="password">パスワード</label></th>
        <td><input type="password" name="password"></td>
      </tr>

      <tr>
        <th align="left"><label for="password_confirmation">パスワード確認</label></th>
        <td><input type="password" name="password_confirmation"></td>
      </tr>

      <tr>
        <th align="left"><label for="bio">自己紹介</label></th>
        <td><input type="text" name="bio" value="{{ Auth::user()->bio }}"></td>
      </tr>

      <tr>
        <th align="left"><label for="profile_image">アイコン画像</label></th>
        <td><input type="file" name="profile_image"></td>
      </tr>
    </table>

    <div style="text-align: center; margin: 20px;">
      <button class="form-submit" type="submit">更新</button>
    </div>
  </form>
</div>

@endsection
