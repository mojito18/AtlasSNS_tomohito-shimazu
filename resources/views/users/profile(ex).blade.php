@extends('layouts.login')

@section('content')

<div class="profile-main">
  <img src="{{ asset('images/' . $user->images) }}" class="profile-user">

  <div class="byYourself">
    <table>
      <tr>
        <th>ユーザー名</th>
        <td>{{ $user->username }}</td>
      </tr>
      <tr>
        <th>自己紹介</th>
        <td>{{ $user->bio }}</td>
      </tr>
    </table>
  </div>

  <!--ログインしているユーザーがユーザーを（$user）フォローしていない場合-->
  @if(Auth::user()->isFollowing($user->id))
  <!-- userテーブルからidを取り出す（カラム） -->
  {!! Form::open(['url' => '/user/unfollow/' . $user->id,'method' =>'post']) !!}
  <!--unfolloｗのweb.phpのURLに変更-->
  {!! form::submit('フォロー解除',['class' => 'unfollow-btns'])!!}
  {!! Form::close() !!}
  @else
  {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
  {!! form::submit('フォロー',['class' => 'follow-btns'])!!}
  {!! Form::close() !!}
  @endif
</div>

@foreach ($user->posts as $post)
<div class="profile-block">
  {!! Form::image('/images/icon2.png', 'submit', ['class' => 'profile-user']) !!}
  <div class="profile-line">
    <div class="profile-name">{{ $post->user->username }}</div>
    <div class="profile-post"> {{ $post->post }}</div>
  </div>
  <!--投稿日時  -->
  <p class="post-date"> {{ $post->created_at ->format('Y-m-d H:i')}}</p>
</div>
@endforeach
@endsection
