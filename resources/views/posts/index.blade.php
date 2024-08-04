@extends('layouts.login')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/post/create']) !!}
<h2>あいうえお</h2>

<!-- CSRF保護 -->
    {!! csrf_field() !!}
    <!-- 内容入力 -->
    <div>
        {!! Form::label('content', '内容:') !!}
        {!! Form::textarea('content', null, ['required' => 'required']) !!}
    </div>
    <!-- 送信ボタン -->
    <div>
        {!! Form::submit('投稿') !!}
    </div>

{!! Form::close() !!}
<!--投稿一覧表示-->
<h2>投稿一覧</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error')}}
</div>
@endif

@foreach($posts as $post)
<div class="post">
    <p>{{ $post->post}}</p><!--投稿内容表示-->
    <p>投稿者: {{ $post->user->username }}</p><!--投稿者の名前-->

    @if($post->user_id == Auth::id())

<!--削除ボタン-->
<a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')">削除</a>


@endif
</div>
@endforeach
@endsection
