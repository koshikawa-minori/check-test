<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;



Route::middleware(['auth'])->group(
  function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

    Route::delete('/admin/contacts/{contact}', [AdminController::class, 'destroy'])
      ->name('admin.contacts.destroy');

  });

//お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/', [ContactController::class, 'index']);
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks',  [ContactController::class, 'thanks'])->name('contact.thanks');

//認証
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

