@extends('layouts.login')

@section('content')
フォロワーリスト
@foreach($followers as $user)
<!--アイコンにプロフィールURLに移行-->
    <div class="user">
      <a href="{{ route('users.OtherUsers', $user) }}">
        <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icon"></a>
        <p>{{ $user->username }}</p>
    </div>
@endforeach

@foreach($posts as $post)
<p>名前：{{ $post->user->username }}</p>
<p>投稿内容：{{ $post->post }}</p>
@endforeach

@endsection
