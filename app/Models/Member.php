<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Definisikan kolom yang dapat diisi
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}