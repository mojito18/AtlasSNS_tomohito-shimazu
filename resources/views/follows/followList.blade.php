@extends('layouts.login')

@section('content')


<div class="userList">
  <h8 class="fList">フォロ-リスト</h8>
  <div class="user-main">
    @foreach($followed_users as $user)
    <a href="{{ route('users.OtherUsers', $user) }}">
      <!--ここが元々ルーティングのusers.profileに飛ぶようになっていた-->
      <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icons">
    </a>
    <!-- <p>{{ $user->username }}</p> -->
    @endforeach
  </div>
</div>
@foreach($posts as $post)
<div class="pastPost">
  <img src="{{ asset('images/' . $user->images) }}" alt="{{ $user->username }}のアイコン" class="user-icon">
  <div class="post-main">
    <p>{{ $post->user->username }}</p>
    <p>{{ $post->post }}</p>
  </div>
  <p class="post-date">{{ $post->created_at }}</p>

</div>
@endforeach
@endsection

<!--フォローリスト-->
