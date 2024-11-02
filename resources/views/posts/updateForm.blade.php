<body class="">
  <head>
    <h1 class="">Laravelを使った投稿機能の実装</h1>
  </head>
  <div class="">
    <h2 class="">投稿内容を変更する</h2>
    {!! Form::open['url' => '/post/update'] !!}
    <div class="">
      {!! Form::hidden('id',$post->id) !!}
      {!! From::input('text','update',$post->post['required','class' => 'form-control']) !!}
    </div>
    <button type="submit" class="">更新</button>
    {!! Form::close() !!}
  </div>
</body>
