@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2 class="newUser">新規ユーザー登録</h2>

<p class="newName">ユーザー名</p>

<div class="inputName">{{ Form::text('username',null,['class' => 'input','placeholder' => 'ユーザー名']) }}
  @error('username')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<p class="newMail">メールアドレス</p>
{{ Form::label('メールアドレス') }}
<div class="inputMail">{{ Form::text('mail',null,['class' => 'input','input','placeholder' => 'メールアドレス']) }}
  @error('mail')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<p class="newPassword">パスワード</p>
{{ Form::label('パスワード') }}
<div class="inputPassword">{{ Form::text('password',null,['class' => 'input','placeholder' => 'パスワード']) }}
  @error('password')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<p class="newPassword_confirmation">パスワード確認</p>
{{ Form::label('パスワード確認') }}
<div class="inputPassword_confirmation">{{ Form::text('password_confirmation',null,['class' => 'input','placeholder' => 'パスワード']) }}
  @error('password_confirmation')
  <div class="alert alert-danger">{{ $message }}
  </div>
  @enderror

</div>

<div class="newSubmit">{{ Form::submit('新規登録',['class' => 'new-submit']) }}</div>

<p class="backLogin"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
