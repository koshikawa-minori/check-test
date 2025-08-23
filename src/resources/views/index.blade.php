@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
  <div class="contact-form__content">
    <div class="contact-form__head">
      <h2>Contact</h2>
    </div>
    <form class="form" action="/confirm" method="post">
      @csrf
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">お名前</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content name-row">
          <div class="form__input-wrapper">
            <div class="form__input--text">
              <input class="input-item" type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}"/>
            </div>
            <div class="form__error">
              @error('last_name') {{ $message }} @enderror
            </div>
          </div>
          <div class="form__input-wrapper">
            <div class="form__input--text">
              <input class="input-item" type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}"/>
            </div>
            <div class="form__error">
              @error('first_name') {{ $message }} @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">性別</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content is-column">
            <div class="gender-wrapper">
                @php $g = old('gender', $contact['gender'] ?? '男性'); @endphp
              <input id="gender-male"   type="radio" name="gender" value="男性"  {{ $g==='男性' ? 'checked' : '' }}>
              <label for="gender-male"   class="input-gender">男性</label>

              <input id="gender-female" type="radio" name="gender" value="女性"  {{ $g==='女性' ? 'checked' : '' }}>
              <label for="gender-female" class="input-gender">女性</label>

              <input id="gender-other"  type="radio" name="gender" value="その他" {{ $g==='その他' ? 'checked' : '' }}>
              <label for="gender-other"  class="input-gender">その他</label>
            </div>
            <div class="form__error">
              @error('gender') {{ $message }} @enderror
            </div>
        </div>
      </div>

      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">メールアドレス</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content">
          <div class="form__input-wrapper">
            <div class="form__input--text">
              <input class="input-item" type="email" name="email" placeholder="例：test@example.com" value="{{ old('email')}}"/>
            </div>
            <div class="form__error">
              @error('email') {{ $message }} @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">電話番号</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content tel-wrapper is-column">
          <div class="form__input-wrapper">
            <input class="input-item" type="text" name="tel1" placeholder="例:080" value="{{ old('tel1') }}"/>
            <span class="tel-sep">-</span>
            <input class="input-item" type="text" name="tel2" placeholder="例:1234" value="{{ old('tel2') }}"/>
            <span class="tel-sep">-</span>
            <input class="input-item" type="text" name="tel3" placeholder="例:5678" value="{{ old('tel3') }}"/>
          </div>
          @php
            $telError = $errors->first('tel1') ?: $errors->first('tel2') ?: $errors->first('tel3');
          @endphp
          @if($telError)
            <div class="form__error">{{ $telError }}</div>
          @endif
        </div>
      </div>
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">住所</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content">
          <div class="form__input-wrapper">
            <div class="form__input--text">
              <input class="input-item" type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address')}}"/>
            </div>
            <div class="form__error">
              @error('address') {{ $message }} @enderror
            </div>
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">建物名</span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input class="input-item" type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building')}}"/>
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group--title">
          <span class="form__title">お問い合わせの種類</span>
          <span class="form__mark">※</span>
        </div>
        <div class="form__group--content is-column">
          <div class="form__input-wrapper select-wrapper">
            <select class="input-item" name="kind">
              <option value="">選択してください</option>
              <option>商品のお届けについて</option>
              <option>商品の交換について</option>
              <option>商品トラブル</option>
              <option>ショップへのお問い合わせ</option>
              <option>その他</option>
            </select>
          </div>
          <div class="form__error">
            @error('kind'){{ $message }}@enderror
          </div>
        </div>
      </div>
      <div class="form__group form__group--textarea">
          <div class="form__group--title">
            <span class="form__title">お問い合わせ内容</span>
            <span class="form__mark">※</span>
          </div>
          <div class="form__group--content">
            <div class="form__input-wrapper">
              <div class="form__input--detail">
                <textarea class="input-item" name="detail" placeholder="例：お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
              </div>
              <div class="form__error">
                @error('detail') {{ $message }} @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button--submit" type="submit">
            確認画面
          </button>
        </div>
    </form>
  </div>
@endsection