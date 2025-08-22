@extends('layouts.app')

@section('css')
<!--CSS書く-->

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
          <span class="form__title">
            お名前
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name', $contact['last_name'] ?? '') }}"/>
          </div>
          <div class="form__error">
            @error('last_name')
            {{ $message }}
            @enderror
          </div>
          <div class="form__input--text">
            <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name', $contact['first_name'] ?? '') }}"/>
            @error('first_name')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            性別
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="radio" name="gender" value="男性"
            {{ (old('gender',$content['gender'] ?? '男性') ==='男性') ? 'checked' : ""}}/>男性
            <input type="radio" name="gender" value="女性"
            {{ (old('gender',$content['gender'] ?? '男性') ==='女性') ? 'checked' : ""}}/>女性
            <input type="radio" name="gender" value="その他"
            {{ (old('gender',$content['gender'] ?? '男性') ==='その他') ? 'checked' : ""}}/>その他
          </div>
  <!-- バリデーション上記コピペ修正-->
        </div>
        <div class="form__group--title">
          <span class="form__title">
            メールアドレス
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email')}}"/>
            @error('email')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            電話番号
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="number" name="tel1" placeholder="例：080" value="{{ old('tel1')}}"/>
  <!-- バリデーション上記コピペ修正-->
          </div>
          <div class="form__input--text">
            <input type="number" name="tel2" placeholder="例：1234" value="{{ old('tel2')}}"/>
  <!-- バリデーション上記コピペ修正-->
          </div>
          <div class="form__input--text">
            <input type="number" name="tel3" placeholder="例：5678" value="{{ old('tel3')}}"/>
  <!-- バリデーション上記コピペ修正-->
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            住所
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address')}}"/>
            @error('address')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            建物名
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building')}}"/>
            @error('building')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            お問い合わせの種類
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <select name="kind">
              <option value="">選択してください</option>
              <option>商品のお届けについて</option>
              <option>商品の交換について</option>
              <option>商品トラブル</option>
              <option>ショップへのお問い合わせ</option>
              <option>その他</option>
            </select>
  <!-- バリデーション上記コピペ修正-->
          </div>
        </div>
        <div class="form__group--title">
          <span class="form__title">
            お問い合わせ内容
          </span>
          <span class="form__mark">
            ＊
          </span>
        </div>
        <div class="form__group--content">
          <div class="form__input--text">
            <textarea name="detail" placeholder="例：お問い合わせ内容をご記載ください">{{ old('detail')}}</textarea>
            @error('detail')
            {{ $message }}
            @enderror
          </div>
        </div>
        <div class="form__button">
          <button class="form__button--submit" type="submit">
            確認画面
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection