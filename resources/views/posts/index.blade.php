@extends('layouts.login')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/post/create']) !!}

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

    <h2>投稿一覧</h2>
    @foreach($posts as $post)<!--モーダル削除，編集ボタン　10/24-->
    <div class="post">
    <p>{{ $post->post}}</p><!--投稿内容表示-->
    <p>投稿者: {{ $post->user->username }}</p><!--投稿者の名前-->

@if($post->user_id == Auth::id())
<!--削除ボタン-->
<a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>

<!-- 投稿の編集ボタン -->
  <div class="content">
        <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}">編集</a><!--アップデートしたいpost_idとログインuserのidと実際に投稿したアップデートしたない-->
    </div>
@endif

</div>
    @endforeach
     <!-- モーダルの中身 -->
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
           <form action="/post/update" method="post">
                <textarea name="post" class="modal_post"></textarea>
                <input type="hidden" name="id" class="modal_id" value="">
                <input type="submit" value="更新">
                {{ csrf_field() }}
           </form>
           <a class="js-modal-close" href="">閉じる</a>
        </div>
    </div>

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
@endsection
