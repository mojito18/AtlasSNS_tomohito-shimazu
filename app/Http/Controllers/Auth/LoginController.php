<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/top';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // ログインフォームのバリデーションルールを定義
            $request->validate([
                'mail' => 'required|email|max:40', // メールアドレスは必須、有効な形式、最大40文字
                'password' => 'required|alpha_num|min:8|max:20', // パスワードは必須、英数字、8文字以上20文字以内
            ], [ // ここにカスタムメッセージの配列を追加
                'mail.required' => 'メールアドレスは必ず入力してください。',
                'mail.email' => '有効なメールアドレス形式で入力してください。',
                'password.required' => 'パスワードは必ず入力してください。',
                'password.alpha_num' => 'パスワードは英数字で入力してください',
                'password.min' => 'パスワードは8文字以上入力してください',
                'password.max' => 'パスワードは20文字以下入力してください',
            ]);


            $data = $request->only('mail', 'password');
            // ログインが成功したら、トップページへ
            //↓ログイン条件は公開時には消すこと
            if (Auth::attempt($data)) {
                return redirect('/top');
            } else {
                // ログイン失敗時の処理
                // エラーメッセージをセッションにフラッシュする
                return redirect('/login')->withErrors([
                    'login_error' => 'メールアドレスまたはパスワードが間違っています。' // 任意のキーとメッセージ
                ])->withInput($request->only('mail')); // 入力されたメールアドレスを保持
            }
        }
        return view("auth.login");
    }
    //ログアウトメソット
    public function  logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
