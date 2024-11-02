@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->

{!! Form::open(['url' => '/login']) !!}
<p>AtlasSNSへようこそ</p>

<div class="form">

<div class="name-mail">{{ Form::label('e-mail') }}</div>
<div class="form-mail">{{ Form::text('mail',null,['class' => 'input']) }}</div>
<div class="name-password">{{ Form::label('password') }}</div>
<div class="form-password">{{ Form::password('password',['class' => 'input']) }}</div>

</div>
{{ Form::submit('ログイン') }}
<div class=""><p class=""><a href="/register">新規ユーザーの方はこちら</a></p></div>

{!! Form::close() !!}
@endsection
