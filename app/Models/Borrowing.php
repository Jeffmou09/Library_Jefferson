<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'borrowings';

    // Menentukan atribut yang boleh diisi (fillable)
    protected $fillable = [
        'member_id',
        'book_id',
        'borrow_date',
        'due_date',
        'status',
        'return_date',
    ];

    // Relasi dengan model Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Akses status borrows untuk mendeteksi status berdasarkan return_date dan due_date
    public function getStatusAttribute()
    {
        // Jika sudah mengembalikan, maka status menjadi returned
        if ($this->return_date) {
            return 'Returned';
        }

        // Jika belum mengembalikan dan sudah melewati due_date, maka statusnya late
        if (now()->gt($this->due_date)) {
            return 'Late';
        }

        // Default status adalah borrowed jika belum dikembalikan
        return 'Borrowed';
    }
}
