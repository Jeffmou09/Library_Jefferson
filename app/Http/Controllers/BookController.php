<?php

namespace App\Http\Controllers;

use App\Models\Book; // Import model Book
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function destroy($id)
    {
        // Mencari buku berdasarkan ID
        $book = Book::findOrFail($id);
        
        // Menghapus buku
        $book->delete();
        
        // Redirect ke halaman utama setelah menghapus buku
        return redirect('/')->with('success', 'Book deleted successfully!');
    }

    // Menampilkan halaman edit buku
    public function edit($id)
    {
        // Ambil buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Kembalikan halaman edit dengan data buku
        return view('books.edit', compact('book'));
    }

    // Menangani pembaruan data buku
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1000|max:9999',
        ]);

        // Cari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Update data buku
        $book->update($validated);

        // Redirect kembali ke halaman daftar buku dengan pesan sukses
        return redirect('/')->with('success', 'Book updated successfully!');
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan data buku baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1000|max:9999',
        ]);

        // Simpan data ke database
        Book::create($validated);

        // Redirect ke halaman daftar buku atau halaman lain
        return redirect('/')->with('success', 'Book added successfully!');
    }

    public function index()
    {
        // Mengambil semua data buku dari database
        $books = Book::all();

        // Mengirim data buku ke view welcome
        return view('books.welcome', compact('books'));
    }
}