@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
  <div class="confirm__content">
    <div class="confirm__head">
      <h2>Confirm</h2>
    </div>
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm__row is-name">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text" >
            <input class="text-name" type="text" name="last_name" value="{{ $contact['last_name']}}" readonly>
            <input class="text-name" type="text" name="first_name" value="{{ $contact['first_name']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            <input type="text" name="gender" value="{{ $contact['gender']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="text" name="email" value="{{ $contact['email']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="text" name="tel" value="{{ $contact['tel'] ?? ''}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="{{ $contact['address']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="{{ $contact['building']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" name="kind" value="{{ $contact['kind']}}" readonly>
          </td>
        </tr>
        <tr class="confirm__row">
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text">
            <textarea class="table-textarea" name="detail" readonly>{{ $contact['detail']}}</textarea>
          </td>
        </tr>
      </table>
    </div>
    <div class="confirm__button">
      <form action="/thanks" method="post" class="action">
        @csrf
        <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        <input type="hidden" name="email" value="{{ $contact['email'] }}">
        <input type="hidden" name="tel" value="{{ $contact['tel'] ?? '' }}">
        <input type="hidden" name="address" value="{{ $contact['address'] }}">
        <input type="hidden" name="building" value="{{ $contact['building'] }}">
        <input type="hidden" name="kind" value="{{ $contact['kind'] }}">
        <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
        <button type="submit" class="confirm__button--thanks">
          送信
        </button>
      </form>
      <form action="/" method="post">
          @csrf
        <input type="hidden" name="last_name" value="{{ $contact['last_name']}}">
        <input type="hidden" name="first_name" value="{{ $contact['first_name']}}">
        <input type="hidden" name="address" value="{{ $contact['address']}}">
        <input type="hidden" name="gender" value="{{ $contact['gender']}}">
        <input type="hidden" name="email" value="{{ $contact['email']}}">
        <input type="hidden" name="tel" value="{{ $contact['tel'] ?? ''}}">
        <input type="hidden" name="building" value="{{ $contact['building']}}">
        <input type="hidden" name="kind" value="{{ $contact['kind']}}">
        <input type="hidden" name="detail" value="{{ $contact['detail']}}">
        <button class="confirm__button--contact" type="submit">
            修正
        </button>
      </form>
    </div>
  </div>
@endsection