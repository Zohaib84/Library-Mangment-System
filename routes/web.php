<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Apply the admin middleware to admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home',[AdminController::class, 'index']);
    Route::get('/category_page', [AdminController::class, 'category_page']);
    Route::post('/add_category', [AdminController::class, 'add_category']);
    Route::get('/cat_delete/{id}', [AdminController::class, 'cat_delete']);
    Route::get('/cat_edit/{id}', [AdminController::class, 'cat_edit']);
    Route::post('/update_category/{id}', [AdminController::class, 'update_category']);
    Route::get('/add_book', [AdminController::class, 'add_book']);
    Route::post('/store_book', [AdminController::class, 'store_book']);
    Route::get('/show_books', [AdminController::class, 'show_books']);
    Route::get('/book_delete/{id}', [AdminController::class, 'book_delete']);
    Route::get('/edit_book/{id}', [AdminController::class, 'edit_book']);
    Route::put('/update_book/{id}', [AdminController::class, 'update_book']);
    Route::get('/borrow_request', [AdminController::class, 'borrow_request']);
    Route::get('/approve_book/{id}', [AdminController::class, 'approve_book']);
    Route::get('/reject_book/{id}', [AdminController::class, 'reject_book']);
    Route::get('/return_book/{id}', [AdminController::class, 'return_book']);
});

// Routes for normal users
Route::get('/borrow_book/{id}', [HomeController::class, 'borrow_book']);
Route::get('/book_history', [HomeController::class, 'book_history']);
Route::get('/cancel_req/{id}', [HomeController::class, 'cancel_req']);
Route::get('/explore', [HomeController::class, 'explore']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/cat_search/{id}', [HomeController::class, 'cat_search']);

require __DIR__.'/auth.php';
