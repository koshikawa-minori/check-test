@extends('layouts.app')

@section('header-button')
  <a class="header-btn" href="{{ route('login') }}">login</a>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection



@section('content')

<div class= "register__head">
  <h2>Register</h2>
</div>

<div class= "register__group">
  <form method= "POST" action= "{{ route('register') }}" novalidate>
    @csrf

    <div class="register-row__name">
      <label for="name">お名前</label>
      <input type="text" id="name" name="name" value="{{ old('name')  }}" placeholder="例：山田 太郎">
      @error('name')
        <div class="form-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="register-row__email">
      <label for="email">メールアドレス</label>
      <input type="email" id="email" name="email" value="{{ old('email')  }}" placeholder="例：test@example.com">
      @error('email')
        <div class="form-error">{{ $message }}</div>
      @enderror
    </div>

    <div class="register-row__password">
      <label for="password">パスワード</label>
      <input type="password" id="password" name="password"  placeholder="例：coachtech006">
      @error('password')
        <div class="form-error">{{ $message }}</div>
      @enderror
    </div>
    <div class="register__actions">
      <button class="register-button" type="submit">登録</button>
    </div>

  </form>
</div>
@endsection

