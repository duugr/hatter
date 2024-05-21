<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('home');
Route::get('{udid}/{tag?}', WelcomeController::class)
	->name('article')
	->whereNumber('udid')
	->whereAlpha('tag');
Route::get('{tag}', TagController::class)
	->name('tag');
