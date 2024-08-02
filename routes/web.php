<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BerandaController::class, 'landing'])->name('beranda.landing');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/ceklogin', [AuthController::class, 'ceklogin'])->name('ceklogin');

Route::get('/account', [BerandaController::class, 'account'])->name('account')->middleware('guest');
Route::get('/post', [BerandaController::class, 'post'])->name('post')->middleware('guest');

Route::get('/home', [AuthController::class, 'home'])->name('home');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/registered', [AuthController::class, 'registered'])->name('registered');

Route::prefix("account")->group(function () {
    Route::get('/index', [AccountController::class, 'index'])->name('berita.index');
    Route::get('add', [AccountController::class, 'create'])->name('berita.add');
    Route::get('edit/{id}', [AccountController::class, 'edit'])->name('berita.edit');
    Route::post('update/{id}', [AccountController::class, 'update'])->name('berita.update');
    Route::delete('delete/{id}', [AccountController::class, 'delete'])->name('berita.delete');
});

Route::group(['middleware' => ['role:admin']], function () {

});