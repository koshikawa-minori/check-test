<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{

  public function index(Request $request)
  {
    $query = Contact::query()->with('category');


    if ($request->filled('keyword')) {
      $comparison = ($request->input('match') === 'exact') ? '=' : 'like';
      $value = ($comparison === 'like') ? '%' . $request->keyword . '%' : $request->keyword;

      $query->where(function ($query) use ($comparison, $value) {
        $query->where('last_name', $comparison, $value)
          ->orWhere('first_name', $comparison, $value)
          ->orWhereRaw("CONCAT(last_name, first_name) {$comparison} ?", [$value])
          ->orWhere('email', $comparison, $value)
          ->orWhere('detail', $comparison, $value);
      });
    }


    $gender = $request->input('gender');
    if ($gender !== null && $gender !== '' && $gender !== 'all') {
      $query->where('gender', (int)$gender);
    }


    if ($request->filled('category_id')) {
      $query->where('category_id', (int)$request->category_id);
    }


    if ($request->filled('date')) {
      $query->whereDate('created_at', $request->date);
    }

    $contacts = $query
      ->orderBy('created_at', 'desc')
      ->paginate(7)
      ->withQueryString();

    $categories = Category::all(['id', 'content']);
    $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];

    return view('admin', compact('contacts', 'categories', 'genderMap'));
  }


  public function export(Request $request)
  {
    $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';
    $query = Contact::query()->with('category');


    if ($request->filled('keyword')) {
      $comparison = ($request->input('match') === 'exact') ? '=' : 'like';
      $value = ($comparison === 'like') ? '%' . $request->keyword . '%' : $request->keyword;

      $query->where(function ($q) use ($comparison, $value) {
        $q->where('last_name', $comparison, $value)
          ->orWhere('first_name', $comparison, $value)
          ->orWhereRaw("CONCAT(last_name, first_name) {$comparison} ?", [$value])
          ->orWhere('email', $comparison, $value)
          ->orWhere('detail', $comparison, $value);
      });
    }

    $gender = $request->input('gender');
    if ($gender !== null && $gender !== '' && $gender !== 'all') {
      $query->where('gender', (int)$gender);
    }

    if ($request->filled('category_id')) {
      $query->where('category_id', (int)$request->category_id);
    }

    if ($request->filled('date')) {
      $query->whereDate('created_at', $request->date);
    }


    $contacts = $query->orderBy('created_at', 'desc')->get();

    return response()->streamDownload(function () use ($contacts) {
      $out = fopen('php://output', 'w');


      fputcsv($out, ['姓', '名', '性別', 'メール', 'お問い合わせの種類', '作成日']);
      $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];

      foreach ($contacts as $c) {
        fputcsv($out, [
          $c->last_name,
          $c->first_name,
          $genderMap[$c->gender] ?? (string)$c->gender,
          $c->email,
          optional($c->category)->content ?? (string)$c->category_id,
          $c->created_at->format('Y-m-d'),
        ]);
      }

      fclose($out);
    }, $filename, [
      'Content-Type' => 'text/csv; charset=UTF-8',
    ]);
  }


  public function destroy(Contact $contact)
  {
    $contact->delete();
    return redirect()->back()->with('status', '削除しました');
  }
}
