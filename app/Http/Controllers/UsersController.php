<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BD;
use Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(User $user){
        return view('users.profile', compact('user'));
    }

    public function OtherUsers($id){
        //dd($id);
        $user = User::findOrFail($id);
        // 認証済みユーザーのフォローしているユーザーを取得する
        $followingUsers = auth()->user()->follows;
        //ユーザー情報をビューに渡す


        return view('users.profile(ex)',compact('user','followingUsers'));

    }

    public function update(Request $request, User $user){
        //dd($request);
         $request->validate([
            'username'=>'required|min:2|max:12',//ブレードのネーム属性
            'mail'=>'required|email|min:5|max:40',
            'password'=>'required|min:8|max:20|confirmed',
            'password_confirmation'=>'required|min:8|max:20',
            'bio'=>'max:150',
            'profile_image'=>'image|mimes:jpeg,png,bmp,gif,svg',
         ]);

    $images = $request->file('profile_image')->store('public/images');//画像登録（シンボリックリンク）
        $id = Auth::user()->id;
        User::where('id', $id)->update([
            'username' => $request->input('username'),//テーブルに更新情報をインプット
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' =>  basename($images),
        ]);

    return redirect()->route('topPage');//ルート名
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
