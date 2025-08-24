@extends('layouts.app')

@section('content')
  <h1>管理画面</h1>

  <form method="POST" action="/logout" style="margin-top:1rem;">
    @csrf
    <button type="submit">ログアウト</button>
  </form>
@endsection
