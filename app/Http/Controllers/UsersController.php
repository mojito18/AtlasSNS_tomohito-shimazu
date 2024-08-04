<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BD;
use Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    //検索機能実像
    public function search(request $request){
        $user=Auth::user(); //ログインをしているユーザー情報を取得

        //検索ワードを変数で取得
        $keyword = $request->input('word');

        //2つ目の処理
        if (!empty($keyword)) {
            $query = User::query();//使うテーブル
            $query->where('username','LIKE','%'.$keyword.'%');//検索してヒットしたとき
            $query->where('id', '!=', $user->id);//検索してヒットしなかったとき
            $users = $query->get();
            # code...
        } else {
            // キーワードが空の場合、全ユーザーを取得
            $users = User::all();
        }


        return view('users.search',['users'=>$users],['keyword'=>$keyword]);//bladeに定義をする①
    }
}
