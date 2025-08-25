@extends('layouts.app')

@section('content')
<form method="POST" action="/login">
  @csrf

  <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
  @error('email') <div class="form__error">{{ $message }}</div> @enderror

  <input type="password" name="password" placeholder="パスワード">
  @error('password') <div class="form__error">{{ $message }}</div> @enderror

  <button type="submit">ログイン</button>
</form>

<p>
  アカウントをお持ちでない方は
  <a href="{{ route('register') }}">こちらから登録</a>
</p>
@endsection
