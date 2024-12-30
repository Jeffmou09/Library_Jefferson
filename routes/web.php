<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;

Route::get('/', [BookController::class, 'index']);
Route::post('/', [BookController::class, 'store'])->name('books.store');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/{id}', [BookController::class, 'destroy'])->name('books.destroy');

Route::get('/members', [MemberController::class, 'index']);
Route::post('/members', [MemberController::class, 'store'])->name('members.store');
Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

Route::get('/borrowings', function () {
    return view('borrowings');
})->name('borrowings');
