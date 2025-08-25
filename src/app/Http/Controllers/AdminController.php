<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

  public function index(Request $request)
  {
    $dbName   = DB::connection()->getDatabaseName();
    $totalAll = \App\Models\Contact::count();

    $last = $request->query('last_name');
    if (is_null($last)) {
      $last = '';
    }

    $first = $request->query('first_name');
    if (is_null($first)) {
      $first = '';
    }

    $full = $request->query('full_name');
    if (is_null($full)) {
      $full = '';
    }

    $email = $request->query('email');
    if (is_null($email)) {
      $email = '';
    }

    $gender = $request->query('gender');
    if (is_null($gender)) {
      $gender = '';
    }

    $categoryId = $request->query('category_id');
    if (is_null($categoryId)) {
      $categoryId = '';
    }

    $date = $request->query('date');
    if (is_null($date)) {
      $date = '';
    }

    $mode = $request->query('match');
    if (is_null($mode)) {
      $mode = 'partial';
    }

    $query = Contact::query();

    $comparison = $request->input('match', 'partial') === 'exact' ? '=' : 'like';


    if ($last !== '') {
      if ($comparison === '=') {
        $query->where('last_name', '=', $last);
      } else {
        $query->where('last_name', 'like', "%{$last}%");
      }
    }

    if ($first !== '') {
      if ($comparison === '=') {
        $query->where('first_name', '=', $first);
      } else {
        $query->where('first_name', 'like', "%{$first}%");
      }
    }

    if ($full !== '') {
      if ($comparison === '=') {
        $query->whereRaw("CONCAT(last_name, first_name) = ?", [$full]);
      } else {
        $query->whereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$full}%"]);
      }
    }

    if ($email !== '') {
      if ($comparison === '=') {
        $query->where('email', '=', $email);
      } else {
        $query->where('email', 'like', "%{$email}%");
      }
    }

    if ($gender !== '' && in_array((string)$gender, ['1', '2', '3'], true)) {
      $query->where('gender', '=', (int)$gender);
    }

    if ($categoryId !== '') {
      $query->where('category_id', '=', (int)$categoryId);
    }

    if ($date !== '') {
      $query->whereDate('created_at', '=', $date);
    }

    $items = $query->orderByDesc('id')->paginate(7)->appends($request->query());

    $categories = Category::all(['id', 'content']);

    return view('admin', [
      'items'       => $items,
      'categories'  => $categories,
      'last_name'   => $last,
      'first_name'  => $first,
      'full_name'   => $full,
      'email'       => $email,
      'gender'      => $gender,
      'category_id' => $categoryId,
      'date'        => $date,
      'match'       => $comparison === '=' ? 'exact' : 'partial',
      'dbName'   => $dbName,
      'totalAll'    => $totalAll,
    ]);
  }
}
