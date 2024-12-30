<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function destroy($id)
    {
        // Mencari member berdasarkan ID
        $member = Member::findOrFail($id);
        
        // Menghapus member
        $member->delete();
        
        // Redirect ke halaman utama setelah menghapus member
        return redirect('/members')->with('success', 'Member deleted successfully!');
    }

    public function edit($id)
    {
        // Ambil member berdasarkan ID
        $member = Member::findOrFail($id);

        // Kembalikan halaman edit dengan data member
        return view('members.edit', compact('member'));
    }

    // Menangani pembaruan data member
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
        ]);

        // Cari member berdasarkan ID
        $member = Member::findOrFail($id);

        // Update data member
        $member->update($validated);

        // Redirect kembali ke halaman daftar member dengan pesan sukses
        return redirect('/members')->with('success', 'Member updated successfully!');
    }

    public function create()
    {
        return view('members.create');
    }

    // Menyimpan member buku baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15', // Validasi untuk nomor telepon
        ]);

        // Simpan data ke database
        Member::create($validated);

        // Redirect ke halaman daftar member atau halaman lain
        return redirect('/members')->with('success', 'Member added successfully!');
    }

    public function index()
    {
        // Mengambil semua data buku dari database
        $members = Member::all();

        // Mengirim data buku ke view welcome
        return view('members.members', compact('members'));
    }
}
