@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->

{!! Form::open(['url' => '/login']) !!}


<p class="title-open">AtlasSNSへようこそ</p>

<div class="form">

  <div class="name-mail">{{ Form::label('e-mail','メールアドレス') }}</div>
  <div class="form-mail">{{ Form::text('mail',null,['class' => 'input','placeholder' => 'メールアドレス']) }}
    @error('mail')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

  <div class="name-password">{{ Form::label('password','パスワード') }}</div>
  <div class="form-password">{{ Form::password('password',['class' => 'input','placeholder' => 'パスワード']) }}
    {{-- パスワードのバリデーションエラーメッセージ --}}
    @error('password')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>

</div>

<div class="login-button">{{ Form::submit('ログイン',['class' => 'button-submit']) }}</div>
<p class="new-user"><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
@endsection
