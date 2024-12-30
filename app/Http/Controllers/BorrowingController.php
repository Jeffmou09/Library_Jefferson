<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        // Mengambil semua data peminjaman
        $borrowings = Borrowing::with(['member', 'book'])->get();
        return view('borrowings.borrowings', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::all(); // Mengambil semua anggota
        $books = Book::all(); // Mengambil semua buku
        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id', // Memastikan member_id ada di tabel members
            'book_id' => 'required|exists:books,id',     // Memastikan book_id ada di tabel books
            'borrow_date' => 'required|date',            // Memvalidasi tanggal peminjaman
        ]);

        // Cek apakah buku sudah dipinjam dan belum dikembalikan
        $existingBorrowing = Borrowing::where('book_id', $validated['book_id'])
                                    ->where('status', 'borrowed')
                                    ->whereNull('return_date') // Pastikan return_date null (belum dikembalikan)
                                    ->first();

        // Jika buku sudah dipinjam, tampilkan pesan error
        if ($existingBorrowing) {
            return redirect()->back()->withErrors(['book_id' => 'Buku ini sudah dipinjam dan belum dikembalikan.']);
        }

        // Tambahkan due_date otomatis 7 hari setelah borrow_date
        $validated['due_date'] = \Carbon\Carbon::parse($validated['borrow_date'])->addDays(7);

        // Membuat data peminjaman baru
        Borrowing::create($validated);

        // Redirect kembali dengan pesan sukses
        return redirect('/borrowings')->with('success', 'Borrowing added successfully!');
    }

    public function edit($id)
    {
        // Ambil data peminjaman berdasarkan ID
        $borrowing = Borrowing::findOrFail($id);
        
        // Ambil data anggota dan buku untuk dropdown
        $members = Member::all();
        $books = Book::all();

        // Kembalikan ke halaman edit dengan data anggota, buku, dan peminjaman yang ditemukan
        return view('borrowings.edit', compact('borrowing', 'members', 'books'));
    }

    // Proses untuk memperbarui data peminjaman
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id', 
            'book_id' => 'required|exists:books,id',     
            'borrow_date' => 'required|date',           
            'status' => 'required|in:Borrowed,Returned', 
            'return_date' => 'nullable|date',       
        ]);

        // Ambil data peminjaman berdasarkan ID
        $borrowing = Borrowing::findOrFail($id);

        // Tambahkan due_date otomatis 7 hari setelah borrow_date
        $validated['due_date'] = \Carbon\Carbon::parse($validated['borrow_date'])->addDays(7);

        // Jika status yang dipilih adalah 'returned', set tanggal pengembalian
        if ($validated['status'] == 'returned') {
            $validated['return_date'] = now(); // Mengisi return_date dengan waktu sekarang
        } else {
            // Jika status bukan 'returned', pastikan return_date tetap null
            $validated['return_date'] = null;
        }

        // Perbarui data peminjaman
        $borrowing->update($validated);

        // Redirect kembali dengan pesan sukses
        return redirect('/borrowings')->with('success', 'Borrowing updated successfully!');
    }

    public function returnBook(Borrowing $borrowing)
    {
        // Mengupdate status peminjaman menjadi 'returned' dan memasukkan tanggal pengembalian
        $borrowing->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect('/borrowings')->with('success', 'Book returned successfully!');
    }

    public function destroy($id)
    {
        // Mencari member berdasarkan ID
        $borrowing = Borrowing::findOrFail($id);
        
        // Menghapus member
        $borrowing->delete();
        
        // Redirect ke halaman utama setelah menghapus member
        return redirect('/borrowings')->with('success', 'Borrowing deleted successfully!');
    }

    public function updateStatus(Borrowing $borrowing)
    {
        // Jika buku dikembalikan, set status menjadi 'returned'
        if (!$borrowing->return_date) {
            $borrowing->update([
                'return_date' => now(),  // Menyimpan tanggal pengembalian
                'status' => 'returned',
            ]);
        } else {
            // Jika sudah dikembalikan, set status menjadi 'borrowed'
            $borrowing->update(['status' => 'borrowed']);
        }

        return redirect()->route('borrowings.borrowings')->with('success', 'Borrowing status updated successfully!');
    }
}
