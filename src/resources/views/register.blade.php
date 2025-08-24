@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<form class="form" action="/register" method="post">
  @csrf

  <input type="text"     name="name"                  placeholder="名前"           value="{{ old('name') }}">
  @error('name') <div class="form__error">{{ $message }}</div> @enderror

  <input type="email"    name="email"                 placeholder="メールアドレス" value="{{ old('email') }}">
  @error('email') <div class="form__error">{{ $message }}</div> @enderror

  <input type="password" name="password"              placeholder="パスワード">
  @error('password') <div class="form__error">{{ $message }}</div> @enderror

  <input type="password" name="password_confirmation" placeholder="パスワード確認用">

  <button class="form__button--submit" type="submit">登録</button>
</form>
@endsection
