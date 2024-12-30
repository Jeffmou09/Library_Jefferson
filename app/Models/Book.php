<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Definisikan kolom yang dapat diisi
    protected $fillable = [
        'title',
        'author',
        'year_published',
    ];
}