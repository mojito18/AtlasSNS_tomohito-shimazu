@extends('layouts.login')

@section('content')
<!-- 適切なURLを入力してください -->

<div class="newOpen">
  {!! Form::open(['url' => '/post/create']) !!}

  <div class="text-form">
    {!! Form::image('/images/icon1.png', 'submit', ['class' => 'user-image']) !!}
    <!-- CSRF保護 -->
    {!! csrf_field() !!}
    <!-- 内容入力 -->
    <!--内容を薄く表示させる-->

    <div class="content">
      {!! Form::textarea(
      'content',
      null,
      [
      'required' => 'required',
      'class' => 'post-class',
      'placeholder' => '投稿内容を入力してください',
      'class' => 'post-class post-text'
      ]
      ) !!}
    </div>
    <div class="sbt">
      {!! Form::image('/images/post.png', 'submit', ['class' => 'submit-image']) !!}
    </div>
  </div>
  {!! Form::close() !!}
</div>
@foreach($posts as $post)
<!--モーダル削除，編集ボタン　10/24-->
<!-- 投稿ユーザーアイコン -->
<div class="userBox">
  {!! Form::image('/images/icon2.png', 'submit', ['class' => 'postUser-image']) !!}

  <div class="nextBox">
    <!--投稿者の名前-->
    <p class="postUser"> {{ $post->user->username }}</p>
    <!--投稿内容表示-->
    <p class="post">{!! nl2br(e($post->post)) !!}</p>
  </div>

  <div class="date-btn">
    <!--投稿日時  -->
    <p class="post-date">投稿日: {{ $post->created_at ->format('Y-m-d H:i')}}</p>


    @if($post->user_id == Auth::id())
    <div class="btn-box">

      <!-- 投稿の編集ボタン -->

      <img src="/images/edit.png" class="delete-icon js-modal-open" data-post="{{ $post->post }}" data-post-id="{{ $post->id }}" style="cursor: pointer;">
      <!--アップデートしたいpost_idとログインuserのidと実際に投稿したアップデートしたない-->
      <!--削除ボタン-->
      <img src="/images/trash-h.png" class="delete-icon js-delete-modal-open" data-post-id="{{ $post->id }}" style="cursor: pointer;">
    </div>
    @endif
  </div>
</div>
@endforeach
<!--モーダル記述はendforeachの外に出す-->
<!-- 編集モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.update') }}" method="POST">
      @csrf
      <textarea name="post" class="modal_post"></textarea>
      <input type="hidden" name="id" class="modal_id">
      <input type="submit" value="更新">
    </form>
    <a class="js-modal-close" href="">閉じる</a>
  </div>
</div>


<!-- デリートモーダル作成 -->

<div class="modal js-delete-modal">
  <div class="js-delete-modal-close"></div>
  <div class="modal_delete_content">
    <p>こちらの投稿を削除してもよろしいでしょうか？</p>
    <form id="deleteForm" method="post">
      @csrf
      @method('DELETE')
      <div class="box-button">
        <button type="submit" class="btn-ok">OK</button>
        <button type="button" class="btn-cancel js-delete-modal-close">キャンセル</button>
      </div>
    </form>
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
