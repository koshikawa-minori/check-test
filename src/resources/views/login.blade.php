@extends('layouts.app')

@section('header-button')
  <a href="{{ route('register') }}" class="header-btn">register</a>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection

@section('content')

<div class = "login__head">
  <h2>Login</h2>
</div>

<div class ="login__group">
  <form method ="POST" action ="{{ route('login') }}" novalidate>
    @csrf
    <div class="form-group__email">
      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com" autocomplete="email"
          required>
      @error('email')
        <div class="form-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group__password">
      <label for="password">パスワード</label>
      <input type="password" id="password" name="password" placeholder="例：coachtech006" autocomplete="current-password"
          required>
      @error('password')
        <div class="form-error">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-actions">
      <button class="form-button" type="submit">ログイン</button>
    </div>


  </form>
</div>
@endsection