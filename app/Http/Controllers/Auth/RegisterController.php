<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            //バリデーションの設定
            $request->validate([
                'username' => 'required|min:2|max:12',
                'mail' => 'required|unique:users,mail|min:5|max:40',
                'password' => 'required|alpha_num|min:8|max:20|confirmed',
            ], [ // 第二引数にメッセージ配列を追加
                'username.required' => 'ユーザー名を入力してください。',
                'username.min' => 'ユーザー名は2文字以上で入力してください。',
                'username.max' => 'ユーザー名は12文字以内で入力してください。',
                'mail.required' => 'メールアドレスを入力してください。',
                'mail.unique' => 'このメールアドレスは既に登録されています。',
                'mail.min' => 'メールアドレスは5文字以上で入力してください。',
                'mail.max' => 'メールアドレスは40文字以内で入力してください。',
                'password.required' => 'パスワードを入力してください。',
                'password.alpha_num' => 'パスワードは英数字で入力してください。',
                'password.min' => 'パスワードは8文字以上で入力してください。',
                'password.max' => 'パスワードは20文字以内で入力してください。',
                'password.confirmed' => 'パスワードが確認用と一致しません。',
            ]);

            $username = $request->input('username');
            $mail = $request->input('mail');
            $password = $request->input('password');

            User::create([
                'username' => $username,
                'mail' => $mail,
                'password' => bcrypt($password),
            ]);
            //セッションを使用してユーザー名表示
            $input = $request->session()->get("username", $username);
            return redirect('added')->with('username', $input);
        }
        return view('auth.register');
    }

    public function added()
    {
        return view('auth.added');
    }
}
