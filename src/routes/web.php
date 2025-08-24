<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::middleware(['auth'])->group(
  function () {
    Route::get(
      '/admin',function () {

        return view('admin');
      }
    );

Route::get('/',        [ContactController::class, 'index'])->name('contact.index');
Route::post('/',       [ContactController::class, 'index']); // 戻る

Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks',  [ContactController::class, 'thanks'])->name('contact.thanks');
  }
);