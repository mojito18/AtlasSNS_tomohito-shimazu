@extends('layouts.login')

@section('content')

<div class="profile-main">
  {{-- アイコンとユーザー情報（テーブル）をまとめるための新しいdivを追加 --}}
  <div class="profile-info-left">
    @if (Auth::user()->images && Auth::user()->images !== 'icon1.png')
    {!! Form::image(asset('/storage/images/' . Auth::user()->images), 'submit', ['class' => 'user-image']) !!}
    @else
    {!! Form::image(asset('/images/icon1.png'), 'submit', ['class' => 'user-image']) !!}
    @endif

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
  </div> {{-- .profile-info-left 終了 --}}

  <div class="swicth">
    @if(Auth::user()->isFollowing($user->id))
    {!! Form::open(['url' => '/user/unfollow/' . $user->id,'method' =>'post']) !!}
    {!! form::submit('フォロー解除',['class' => 'unfollow-btns'])!!}
    {!! Form::close() !!}
    @else
    {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
    {!! form::submit('フォロー',['class' => 'follow-btns'])!!}
    {!! Form::close() !!}
    @endif
  </div>
</div>

@foreach ($user->posts as $post)
<div class="profile-block">
  {!! Form::image(asset('/storage/images/' . $post->user->images), 'submit', ['class' => 'profile-user']) !!}
  <div class="profile-line">
    <div class="profile-name">{{ $post->user->username }}</div>
    <div class="profile-post"> {{ $post->post }}</div>
  </div>
  <p class="post-date"> {{ $post->created_at ->format('Y-m-d H:i')}}</p>
</div>
@endforeach
@endsection
