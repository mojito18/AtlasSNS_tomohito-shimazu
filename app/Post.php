<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //リレーション　１対１
public function user(){
    return $this->belongsTo('App\User');//User::class, 'users_id'変更後
}

    protected $fillable =[
        'post','user_id'//カラム名
    ];

    public function show(){
  // Postモデル経由でpostsテーブルのレコードを取得
  $posts = Post::get();
  return view('yyyy', compact('posts'));
}


}
