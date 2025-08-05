@extends('layouts.login')

@section('content')
<div class="userLists">
  <h8 class="fList">フォロワーリスト</h8>

  @foreach($followers as $user)
  <!--アイコンにプロフィールURLに移行-->
  <div class="">
    <a href="{{ route('users.OtherUsers', $user) }}">
      @if ($user->images && $user->images !== 'icon1.png')
      <img src="{{ asset('/storage/images/' . $user->images) }}" alt="ユーザーアイコン" class="user-image">
      @else
      <img src="{{ asset('/images/icon1.png') }}" alt="デフォルトアイコン" class="user-image">
      @endif
    </a>
    <!-- <p>{{ $user->username }}</p> -->
  </div>
  @endforeach
</div>


@foreach($posts as $post)
<div class="pastPost">
  <div class="">
    <a href="{{ route('users.OtherUsers', $post->user) }}">
      @if ($post->user->images && $post->user->images !== 'icon1.png')
      {!! Form::image(asset('/storage/images/' .$post->user->images) ,'submit', ['class' => 'user-image']) !!}
      @else
      {!! Form::image(asset('/images/icon1.png'), 'submit', ['class' => 'user-image']) !!}
      @endif
    </a>
  </div>

  <div class="post-main">
    <p class="userPost"><b>{{ $post->user->username }}</b></p>
    <p class="postText">{{ $post->post }}</p>
  </div>
  <p class="post-date">{{ $post->created_at ->format('Y-m-d H:i') }}</p>

</div>
@endforeach

@endsection
