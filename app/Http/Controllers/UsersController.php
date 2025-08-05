<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BD;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function OtherUsers($id)
    {
        //dd($id);
        $user = User::findOrFail($id);
        // 認証済みユーザーのフォローしているユーザーを取得する
        $followingUsers = auth()->user()->follows;
        //ユーザー情報をビューに渡す


        return view('users.profile(ex)', compact('user', 'followingUsers'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required|min:2|max:12', //ブレードのネーム属性
            'mail' => 'required|email|min:5|max:40',
            'password' => 'required|string|min:8|max:20| confirmed ', // パスワードは常に必須
            'password_confirmation' => 'required_with:password|string|min:8|max:20',
            'bio' => 'max:150',
            'profile_image' => 'image|mimes:jpeg,png,bmp,gif,svg',
        ];

        //バリデーション時のエラー
        $messages = [
            'username.required' => 'ユーザー名は必ず入力してください。',
            'mail.required' => 'メールアドレスは必ず入力してください。',
            'password.required' => 'パスワードは必ず入力してください。', // パスワードが入力された場合のみ適用されるが、メッセージは必要
            'password.confirmed' => 'パスワードが確認用と一致しません。', // confirmedルールは自動的にpassword_confirmationをチェック
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',
            'password_confirmation.min' => 'パスワード確認は8文字以上で入力してください。',
            'password_confirmation.max' => 'パスワード確認は20文字以内で入力してください。',

            'bio.max' => '自己紹介は150文字以内で入力してください。',

            'profile_image.image' => 'プロフィール画像は画像ファイルである必要があります。',
        ];

        $request->validate($rules, $messages);



        //保存処理
        // $images = $request->file('profile_image')->store('public/images'); //画像登録（シンボリックリンク）
        // デフォルトでは現在の画像を使用
        $filename = Auth::user()->images;

        // ファイルが送られてきていれば、画像を保存して上書き
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/images');
            $filename = basename($path);
        }

        $id = Auth::user()->id;
        User::where('id', $id)->update([
            'username' => $request->input('username'), //テーブルに更新情報をインプット
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => $filename,
        ]);

        return redirect()->route('topPage'); //ルート名
    }

    //検索機能実像
    public function search(request $request)
    {


        $loggedInUserId = Auth::id(); // ログインしているユーザーのIDを取得

        // 検索ワードを取得。もしなければ空文字列に設定。
        $keyword = $request->input('word');

        // Userモデルのクエリビルダを開始
        $query = User::query();

        // 常にログインユーザー自身を除外する条件を追加
        $query->where('id', '!=', $loggedInUserId);

        // キーワードが存在する場合のみ、usernameでの検索条件を追加
        if (!empty($keyword)) {
            $query->where('username', 'LIKE', '%' . $keyword . '%');
        }

        // クエリを実行してユーザーリストを取得
        $users = $query->get(); // get() の代わりに paginate() を使うとページネーションが可能

        // ビューにデータを渡す
        // compact関数を使うと['users' => $users], ['keyword' => $keyword]のように書かずに済む
        return view('users.search', compact('users', 'keyword'));


        // $user = Auth::user(); //ログインをしているユーザー情報を取得

        // //検索ワードを変数で取得
        // $keyword = $request->input('word');

        // //2つ目の処理
        // if (!empty($keyword)) {
        //     $query = User::query(); //使うテーブル
        //     $query->where('username', 'LIKE', '%' . $keyword . '%'); //検索してヒットしたとき
        //     $query->where('id', '!=', $user->id); //検索してヒットしなかったとき
        //     $users = $query->get();
        //     # code...
        // } else {
        //     // キーワードが空の場合、全ユーザーを取得
        //     $users = User::all();
        // }


        // return view('users.search', ['users' => $users], ['keyword' => $keyword]); //bladeに定義をする①
    }
}
