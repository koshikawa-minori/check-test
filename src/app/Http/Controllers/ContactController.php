<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;
use App\Models\Category;


class ContactController extends Controller
{

  public function index(Request $request)
  {
    if ($request->isMethod('post')) {
      return redirect()->route('contact.index')->withInput();
    }
    return view('index');
  }



  public function confirm(ContactRequest $request)
  {
    $tel = $request->filled('tel1')
      ? ($request->tel1 . $request->tel2 . $request->tel3)
      : $request->input('tel', '');
    $request->merge(['tel' => $tel]);
    $categories = Category::pluck('content', 'id')->all();

    $contact = $request->only([
      'category_id',
      'last_name',
      'first_name',
      'gender',
      'email',
      'tel',
      'address',
      'building',
      'detail',
    ]);

    return view('confirm', compact('contact', 'categories'));

  }

  public function store(ContactRequest $request)
  {
    $tel = $request->filled('tel1')
      ? ($request->tel1 . $request->tel2 . $request->tel3)
      : $request->input('tel');
    $request->merge(['tel' => $tel]);

    $contact = $request->only([
      'category_id',
      'last_name',
      'first_name',
      'gender',
      'email',
      'tel',
      'address',
      'building',
      'detail',
    ]);

    $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
    $contact['gender'] = $genderMap[$contact['gender']] ?? null;

    Contact::create($contact);

    return redirect()->route('contact.thanks');

  }

  public function thanks()
  {
    return view('thanks');
  }

}
