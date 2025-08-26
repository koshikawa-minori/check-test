<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ContactRequest extends FormRequest
{

/**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }


  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */


  // app/Http/Requests/ContactRequest.php
  public function rules()
  {
    // 共通
    $common = [
      'category_id' => ['required', 'integer', 'exists:categories,id'],
      'last_name' => ['required', 'string', 'max:255'],
      'first_name' => ['required', 'string', 'max:255'],
      'gender' => ['required', 'in:男性,女性,その他'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'address' => ['required', 'string', 'max:255'],
      'detail' => ['required', 'string', 'max:120'],
    ];

    // 確認画面（/confirm）
    if ($this->routeIs('contact.confirm')) {
      return $common + [
        'tel1' => ['required', 'digits_between:1,5'],
        'tel2' => ['required', 'digits_between:1,5'],
        'tel3' => ['required', 'digits_between:1,5'],
      ];
    }

    // 送信（/thanks → store）
    if ($this->routeIs('contact.store')) {
      return $common + [
        'tel' => ['required', 'digits_between:10,11'],
        'tel1' => ['nullable'],
        'tel2' => ['nullable'],
        'tel3' => ['nullable'],
      ];
    }

    // 念のため
    return $common;
  }


  public function messages()
  {
    return [
      'last_name.required' => '姓を入力してください',
      'first_name.required' => '名を入力してください' ,
      'gender.required' => '性別を選択してください',
      'email.required' => 'メールアドレスを入力してください',
      'email.email' => 'メールアドレスはメール形式で入力してください',
      'tel1.required' => '電話番号を入力してください',
      'tel2.required' => '電話番号を入力してください',
      'tel3.required' => '電話番号を入力してください',
      'tel1.digits_between' => '電話番号は5桁までの数字で入力してください',
      'tel2.digits_between' => '電話番号は5桁までの数字で入力してください',
      'tel3.digits_between' => '電話番号は5桁までの数字で入力してください',
      'address.required' => '住所を入力して下さい',
      'category_id.required' => 'お問い合わせの種類を入力してください',
      'detail.required' => 'お問い合わせ内容を入力してください',
      'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
    ];
  }
}

