<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use BD;
use Auth;

class PostsController extends Controller
{
    public function create(request $request){
         //バリテーションの設定
    $request->validate([
        'content'=>'required|min:1|max:150',
    ]);

    $post = $request->input('content'); //先頭の「＄」がどこにかかっているのか確認

    $user_id=Auth::id(); //ログインユーザーのID情報の取得ができる
    Post::create([
        'post'=>$post,
        'user_id'=>$user_id //'カラム名'＝>'変数'
    ]);

    return redirect('top');
    }

    //トップ画面表示
    public function index(){
        //ログイン認証しているユーザーデータ取得
        $posts = post::get();//postテーブルから投稿（post）を取得

        return view('posts.index',['posts'=>$posts]);
        post::orderBy('created_at','desc')->get();//新しい順に表示
    }
    public function destroy($id)
    {
        $post = post:: find($id);//一つのメソットごとに定義をしないと未定義になる
        //自分の投稿のみ削除にする
        if($post && $post->user_id == Auth::id()){
            $post->delete();
        }
        return redirect('top');
    }
}
