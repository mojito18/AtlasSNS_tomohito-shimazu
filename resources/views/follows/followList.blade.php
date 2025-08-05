@extends('layouts.login')

@section('content')


<div class="userList">
  <h8 class="fList">フォロ-リスト</h8>
  <div class="user-main">
    @foreach($followed_users as $user)
    <a href="{{ route('users.OtherUsers', $user) }}">
      <!--ここが元々ルーティングのusers.profileに飛ぶようになっていた-->
      @if ($user->images && $user->images !== 'icon1.png')
      <img src="{{ asset('/storage/images/' . $user->images) }}" alt="ユーザーアイコン" class="user-image">
      @else
      <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-image">
      @endif
    </a>
    <!-- <p>{{ $user->username }}</p> -->
    @endforeach
  </div>
</div>

<!-- @foreach($followed_users as $followed_user)
<a href="#">
  <img src="{{asset('/storage/images/'.$followed_user->images)}}" alt="{{ $followed_user->username }}のアイコン" class="user-icon">
</a>
@endforeach -->

@foreach($posts as $post)
<div class="pastPost">
  <a href="{{ route('users.OtherUsers', $post->user) }}">
    @if ($post->user->images && $post->user->images !== 'icon1.png')
    {!! Form::image(asset('/storage/images/' .$post->user->images) ,'submit', ['class' => 'user-image']) !!}
    @else
    {!! Form::image(asset('/images/icon1.png'), 'submit', ['class' => 'user-image']) !!}
    @endif
  </a>
  <div class="post-main">
    <p style="margin: 10px 0%;">{{ $post->user->username }}</p>
    <p style="margin: 10px 0%;">{{ $post->post }}</p>
  </div>
  <p class="post-date">{{ $post->created_at ->format('Y-m-d H:i') }}</p>
</div>
@endforeach
@endsection

<!--フォローリスト-->
