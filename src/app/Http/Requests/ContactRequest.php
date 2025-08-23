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


  public function rules()
  {
    return [
      'last_name' => ['required', 'string', 'max:255'],
      'first_name' => ['required', 'string', 'max:255'],
      'gender' => ['required', 'in:男性,女性,その他', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'tel1' => ['required', 'digits_between:2,5'],
      'tel2' => ['required', 'digits_between:2,5'],
      'tel3' => ['required', 'digits_between:2,5'],
      'address' => ['required', 'string', 'max:255'],
      'kind' => ['required', 'max:255'],
      'detail' => ['required', 'string', 'max:120'],
    ];
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
      'tel1.digits_between:1,5' => '電話番号は5桁までの数字で入力してください',
      'tel2.digits_between:1,5' => '電話番号は5桁までの数字で入力してください',
      'tel3.digits_between:1,5' => '電話番号は5桁までの数字で入力してください',
      'address.required' => '住所を入力して下さい',
      'kind.required' => 'お問い合わせの種類を入力してください',
      'detail.required' => 'お問い合わせ内容を入力してください',
      'detail.max' => 'お問い合わせ内容は120文字以内で入力してください',
    ];
  }
}
