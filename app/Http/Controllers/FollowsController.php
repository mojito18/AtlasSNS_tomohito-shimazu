<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
class FollowsController extends Controller
{
    //
    public function followList(){
        //リストアイコン表示
        $user = Auth::user();
        // ログインしているユーザーがフォローしているユーザーリストを取得
        $followed_users = $user->follows()->get();
        //フォローしてる人の投稿表示
        $posts = Post::whereIn('user_id', $followed_users->pluck('id'))
        ->latest() // 投稿日時で降順にソート（新しい投稿順）
        ->paginate(10); // ページネーション

        return view('follows.followList', compact('user', 'followed_users', 'posts')); //bladeに定義をする['']は未定義の変数と同じものを入れる
    }
    public function followerList(){
        //リストアイコン表示
        $user = Auth::user();
        // ログインしているユーザーをフォローしているユーザーリストを取得
        $followers = $user->followers()->get();
        //フォローワの投稿表示
        $posts = Post::whereIn('user_id', $followers->pluck('id'))
        ->latest() // 投稿日時で降順にソート（新しい投稿順）
        ->paginate(10); // ページネーション
        return view('follows.followerList', compact('user', 'followers', 'posts'));//bladeに定義をする['']は未定義の変数と同じものを入れる
    }

    //フォロー機能
    public function follow($id){ //⭐️
        $follower = Auth::user();//user.phpの$thisはここにかかっている
        $if_following = $follower->isFollowing($id);//フォローしているか⭐️
       // DD($id);

        //フォローをしているればtrue,フォローしていなければフォルス
        //if文は，フォローしていなければ動くようにしている
        if (!$if_following){//もしフォローしていなければ
            $follower->follow($id);//フォローする//⭐️($user->$id)から（＄id）に変更 //followは中間テーブル
        }
        return back();
    }

    //フォロー解除機能
    public function unfollow($id){
        $follower = Auth::user();
        $is_Following = $follower->isFollowing($id);
        if($is_Following){
            $follower->unfollow($id);//中間テーブル
        }
        return back();
    }
}
