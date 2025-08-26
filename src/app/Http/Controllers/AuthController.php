<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

  public function login(LoginRequest $request)
  {
    $credentials = $request->only(['email', 'password']);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect('/admin');
    }

    return back()
      ->withErrors(['email' => 'メールアドレスまたはパスワードが正しくありません'])
      ->onlyInput('email');
  }


  public function register(RegisterRequest $request)
  {
    $user = User::create([
      'name'     => $request->name,
      'email'    => $request->email,
      'password' => Hash::make($request->password),
    ]);

    Auth::login($user);
    $request->session()->regenerate();

    return redirect('/admin');
  }
}
