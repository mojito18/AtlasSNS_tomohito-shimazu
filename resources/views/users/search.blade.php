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
      @foreach($users as $user) <!--Userscontrollerから反映①-->
              <li>{{ $user->username }}
                {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
                {!! form::submit('フォロー',['btn btn-primary'])!!}
                {!! Form::close() !!}

                {!! Form::open(['url' => '/user/' . $user->id,'method' =>'post']) !!}
                {!! form::submit('フォロー解除',['btn btn-primary'])!!}
              {!! Form::close() !!}
            </li>
      @endforeach
    </ul>
</div>
@endsection
