<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', [ContactController::class, 'index']);
Route::post('/', [ContactController::class, 'index']);

Route::post('/confirm', [ContactController::class, 'confirm']);

Route::post('/thanks', [ContactController::class, 'store']);

