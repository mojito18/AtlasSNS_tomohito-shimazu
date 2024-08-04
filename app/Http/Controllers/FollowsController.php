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
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
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
        $is_following = $follower->isFollowing($id);
        if($is_following){
            $follower->unfollow($id);
        }
        return redirect('/search');
    }
}
