@extends('layouts.login')

@section('content')
{!! Form::open(['url'  => '/follower-List']) !!}
    <h2>フォロ-リスト</h2>
@foreach($followed_users as $user)
    <div class="user">
        <a href="{{ route('users.OtherUsers', $user) }}"><!--ここが元々ルーティングのusers.profileに飛ぶようになっていた-->
        <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icon"></a>
        <p>{{ $user->username }}</p>
    </div>
    @endforeach

@foreach($posts as $post)
<p>名前：{{ $post->user->username }}</p>
<p>投稿内容：{{ $post->post }}</p>
@endforeach

@endsection

<!--フォローリスト-->
