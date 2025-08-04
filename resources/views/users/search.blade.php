@extends('layouts.login')

@section('content')

<div class="text-search">
  {!! Form::open(['url' =>'/search','method' => 'post']) !!}
  <div class="main-search">
    <!-- {!! Form::label('word','検索ワード') !!} -->
    {!! Form::text('word', null, ['required' => 'required', 'class' => 'search-word', 'placeholder'=>"ユーザー名"]) !!}
    <input type="image" src="/images/search.png" name="search" class="searchSbt">
  </div>
  {!! Form::close() !!}
  <div class="search-keyword">
    @if(!empty($keyword))
    <p class="keyword">検索ワード: {{ $keyword }}</p>
    @endif
  </div>
</div>
<!-- endif消した -->

<ul class="all-user">
  <!--3段構成-->

  @foreach($users as $user)

  <li class="user-item">
    <div class="user-body">
      {!! Form::image('/images/icon7.png', 'submit', ['class' => 'allUser-image']) !!}
      <!--Userscontrollerから反映①-->
      {{ $user->username }}
    </div>
    <!-- ユーザーテーブルから名前（カラム）を引っ張ってくる -->
    <!--ログインしているユーザーがユーザーを（$user）フォローしていない場合-->

    <div class="user-action">
      @if(Auth::user()->isFollowing($user->id))
      <!-- userテーブルからidを取り出す（カラム） -->
      {!! Form::open(['url' => '/user/unfollow/' . $user->id,'method' =>'post']) !!}
      <!--unfolloｗのweb.phpのURLに変更-->
      {!! form::submit('フォロー解除',['class' => 'unfollow-btn'])!!}
      {!! Form::close() !!}
      @else
      {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
      {!! form::submit('フォロー',['class' => 'follow-btn'])!!}
      {!! Form::close() !!}
      @endif
    </div>
  </li>
  @endforeach
</ul>

@endsection
