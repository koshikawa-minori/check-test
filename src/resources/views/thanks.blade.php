@extends('layouts.blank')
@section('header-button') @endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}" >
@endsection


@section('content')
    <div class="thanks__content">
      <p class="background-text">Thank you</p>
      <div class="thanks__content--group">
        <div class="thanks__head">
          <h2 class="thanks__title">お問い合わせありがとうございました</h2>
        </div>
        <div class="thanks__button">
          <a class="thanks__button-submit" href="/">HOME</a>
        </div>
      </div>
    </div>
@endsection
