@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/register']) !!}

<h2 class="newUser">新規ユーザー登録</h2>

<p class="newName">ユーザー名</p>
{{ Form::label('ユーザー名') }}
<div class="inputName">{{ Form::text('username',null,['class' => 'input']) }}</div>

<p class="newMail">メールアドレス</p>
{{ Form::label('メールアドレス') }}
<div class="inputMail">{{ Form::text('mail',null,['class' => 'input']) }}</div>

<p class="newPassword">パスワード</p>
{{ Form::label('パスワード') }}
<div class="inputPassword">{{ Form::text('password',null,['class' => 'input']) }}</div>

<p class="newPassword_confirmation">パスワード確認</p>
{{ Form::label('パスワード確認') }}
<div class="inputPassword_confirmation">{{ Form::text('password_confirmation',null,['class' => 'input']) }}</div>

<div class="newSubmit">{{ Form::submit('新規登録',['class' => 'new-submit']) }}</div>

<p class="backLogin"><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}

@if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
@endif


@endsection
