<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    // 登録画面
    public function index()
    {
        return view('register');
    }

    // 登録処理
    public function register(AuthRequest $request)
    {
        // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録後、自動ログイン
        auth()->login($user);

        // 管理画面にリダイレクト
        return redirect('/admin');
    }

    // ログイン画面
    public function showLoginForm()
    {
        return view('login');
    }

    // ログイン処理
    public function login(LoginRequest $request)
    {
        // 認証情報を取得
        $credentials = $request->only('email', 'password');

        // 認証試行
        if (Auth::attempt($credentials)) {
            // 認証成功
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        // 認証失敗
        return back()->withErrors([
            'password' => 'ログイン情報が登録されていません',
        ])->withInput($request->only('email'));
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
