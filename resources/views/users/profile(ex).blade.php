@extends('layouts.login')

@section('content')
<img src="{{ asset('images/' . $user->images) }}" >
<h2>{{ $user->username }}のプロフィール</h2>

<p>自己紹介: {{ $user->bio }}</p>


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

      @foreach ($user->posts as $post)
                 <div>{{ $post->post }}</div>
      @endforeach
@endsection
