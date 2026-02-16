<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

// お問い合わせ
Route::get('/', [ContactsController::class, 'index']);
Route::post('/confirm', [ContactsController::class, 'confirm'])->name('confirm');
Route::post('/thanks', [ContactsController::class, 'store'])->name('thanks');
Route::get('/thanks', [ContactsController::class, 'thanks'])->name('thanks');

// 認証:登録
Route::get('/register', [AuthController::class, 'index'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// 認証:ログイン
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


// 管理画面（認証必須）
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/search', [AdminController::class, 'search'])->name('search');
    Route::get('/reset', [AdminController::class, 'reset'])->name('reset');
    Route::delete('/delete', [AdminController::class, 'delete'])->name('delete');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});