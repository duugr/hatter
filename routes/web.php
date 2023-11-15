<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', WelcomeController::class)->name('home');
Route::get('{udid}/{tag?}', WelcomeController::class)
	->name('article')
	->whereNumber('udid')
	->whereAlpha('tag');
Route::get('{tag}', TagController::class)
	->name('tag');
