<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
  public function index(){

    return view('index');

  }

  public function confirm(ContactRequest $request)
  {
    $tel = $request->tel1 . "$request->tel2" . "$request->tel3";
    $request->merge(['tel' => $tel]);
    $contact = $request->only([
      'last_name',
      'first_name',
      'gender',
      'email',
      'tel',
      'address',
      'kind',
      'detail',
    ]);

    return view('confirm', compact('contact'));

  }

  public function store(ContactRequest $request)
  {
    $tel = $request->tel1 . "$request->tel2" . "$request->tel3";
    $request->merge(['tel' =>$tel]);
    $contact = $request->only([
      'last_name',
      'first_name',
      'gender',
      'email',
      'tel',
      'address',
      'kind',
      'detail',
    ]);
    Contact::create($contact);
    return view('thanks');

  }

}
