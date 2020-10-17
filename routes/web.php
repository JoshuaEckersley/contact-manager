<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('contacts.index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('contacts.index');
})->name('home');

Route::resource('contacts', ContactController::class)->middleware('auth');
