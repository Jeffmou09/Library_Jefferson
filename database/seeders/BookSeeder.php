<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tambahkan data dummy ke tabel books
        Book::create([
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'year_published' => 1925,
        ]);

        Book::create([
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'year_published' => 1960,
        ]);

        Book::create([
            'title' => 'Feliks Ganteng',
            'author' => 'George Orwell',
            'year_published' => 1949,
        ]);

        Book::create([
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'year_published' => 1999,
        ]);

        Book::create([
            'title' => 'Moby Dick',
            'author' => 'Herman Melville',
            'year_published' => 2001,
        ]);
    }
}