<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::get('/',        [ContactController::class, 'index'])->name('contact.index');
Route::post('/',       [ContactController::class, 'index']); // 戻る用POST受け口

Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks',  [ContactController::class, 'thanks'])->name('contact.thanks');
