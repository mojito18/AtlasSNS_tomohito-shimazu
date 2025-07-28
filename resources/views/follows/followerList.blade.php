@extends('layouts.login')

@section('content')
<div class="userLists">
  <h8 class="fList">フォロワーリスト</h8>

  @foreach($followers as $user)
  <!--アイコンにプロフィールURLに移行-->
  <div class="">
    <a href="{{ route('users.OtherUsers', $user) }}">
      <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icons"></a>
    <!-- <p>{{ $user->username }}</p> -->
  </div>
  @endforeach
</div>


@foreach($posts as $post)
<div class="pastPost">
  <div class="">
    <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
  </div>

  <div class="post-main">
    <p class="userPost">{{ $post->user->username }}</p>
    <p class="postText">{{ $post->post }}</p>
  </div>
  <p class="post-date">投稿日: {{ $post->created_at }}</p>

</div>
@endforeach

@endsection
