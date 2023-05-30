<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/books', function () {
// Route::get('/testroute', [ItemController::class, 'show']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('books.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// refer to 'index' action
Route::get('/', [BookController::class, 'index'])->name('books.index');
//refer to 'detail' action
Route::get('/books/{isbn}', [BookController::class, 'detail'])->name('books.detail');

Route::middleware('auth')->group(function () {
    // refer to 'create' action
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    // refer to 'store' action
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    // refer to 'edit' action
    Route::get('/books/{isbn}/edit', [BookController::class, 'edit'])->name('books.edit');
    // refer to 'update' action
    Route::put('/books/{isbn}', [BookController::class, 'update'])->name('books.update');
    // refer to 'destroy' action
    Route::delete('/books/{isbn}', [BookController::class, 'destroy'])->name('books.destroy');
});


// Route::put('/books/{isbn}/restore', [BookController::class, 'restore'])->name('books.restore');
// Route::get('/books/deleted', [BookController::class, 'deleted'])->name('books.deleted');
