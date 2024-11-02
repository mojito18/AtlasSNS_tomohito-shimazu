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

   //投稿編集 10/28
    // public function updateForm($id){
        // $post = Post::where('id',$id)->first();
    //     return redirect('/top',['post'=>$post]);
    // }

    //モーダル編集 10/28
    public function update(Request $request, post $post){
        $id = $request->input('id');//index44行目nameにpost追記
        $up_post = $request->input('post');//index43行目nameにpost追記
        //DD($up_post);
        \DB::table('posts')
        ->where('id',$id)
        ->update(
            ['post' => $up_post]
        );
        return redirect('top');
    }

    public function userPosts($id)
    {
        // ユーザーを取得
        $user = User::findOrFail($id);

        // ユーザーの投稿を取得
        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        // posts.indexというビューにデータを渡して表示
        return view('posts.index', compact('user', 'posts'));
    }
}
