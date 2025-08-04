<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class PostsController extends Controller
{
    public function create(request $request)
    {
        //バリテーションの設定
        $request->validate([
            'content' => 'required|min:1|max:150',
        ]);

        $post = $request->input('content'); //先頭の「＄」がどこにかかっているのか確認

        $user_id = Auth::id(); //ログインユーザーのID情報の取得ができる
        Post::create([
            'post' => $post,
            'user_id' => $user_id //'カラム名'＝>'変数'
        ]);

        return redirect('top');
    }

    //トップ画面表示
    public function index()
    {
        $followIds = Auth::user()->follows()->pluck('followed_id'); //followed_idでフォロー管理

        $posts = Post::whereIn('user_id', $followIds) //投稿取得
            ->orWhere('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    //投稿編集 10/28
    public function updateForm(Request $request)
    {


        $post = Post::findOrFail($request->id);  // hidden から受け取った id

        $post->post = $request->post;
        $post->save();
        return redirect('/top');
    }


    public function destroy($id)
    {
        $post = post::find($id); //一つのメソットごとに定義をしないと未定義になる
        //自分の投稿のみ削除にする
        // dd($post);
        if ($post && $post->user_id == Auth::id()) {
            $post->delete();
        }
        return redirect('top');
    }
    //モーダル編集 10/28
    public function update(Request $request, post $post)
    {
        $id = $request->input('id'); //index44行目nameにpost追記
        $up_post = $request->input('post'); //index43行目nameにpost追記
        //DD($up_post);
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );
        return view('top');
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
