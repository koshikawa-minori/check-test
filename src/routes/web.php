<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

Route::middleware(['auth'])->group(
  function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

  });


Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/', [ContactController::class, 'index']);

Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks',  [ContactController::class, 'thanks'])->name('contact.thanks');



