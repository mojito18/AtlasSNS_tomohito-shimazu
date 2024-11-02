@extends('layouts.login')

@section('content')

<div>
  {!! Form::open(['url' =>'/search','method' => 'post']) !!}
  <div>
    {!! Form::label('word','検索ワード') !!}
    {!! Form::text('word',null,['required' => 'required']) !!}
  </div>
  <div>
            {!! Form::submit('検索', ['btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}

    <h2>ユーザー一覧</h2>
@if(!empty($keyword))
    <div class="">
      <p>検索ワード: {{ $keyword }}</p>
    </div>
  @endif
<!-- endif消した -->
    <ul>
      <!--3段構成-->
      @foreach($users as $user) <!--Userscontrollerから反映①-->
              {{ $user->username }}
              <!-- ユーザーテーブルから名前（カラム）を引っ張ってくる -->
                <!--ログインしているユーザーがユーザーを（$user）フォローしていない場合-->
      @if(Auth::user()->isFollowing($user->id))
      <!-- userテーブルからidを取り出す（カラム） -->
                {!! Form::open(['url' => '/user/unfollow/' . $user->id,'method' =>'post']) !!} <!--unfolloｗのweb.phpのURLに変更-->
                {!! form::submit('フォロー解除',['btn btn-primary'])!!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
                {!! form::submit('フォロー',['btn btn-primary'])!!}
                {!! Form::close() !!}
              @endif
      @endforeach
    </ul>
</div>
@endsection
