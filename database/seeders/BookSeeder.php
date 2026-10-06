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
        $books = [
            [
                'category_id' => 1, // Fiksi
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'stock' => 15,
            ],
            [
                'category_id' => 1, // Fiksi
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Hasta Mitra',
                'year' => 1980,
                'stock' => 8,
            ],
            [
                'category_id' => 2, // Non-Fiksi
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Harper',
                'year' => 2011,
                'stock' => 12,
            ],
            [
                'category_id' => 3, // Teknologi
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'stock' => 10,
            ],
            [
                'category_id' => 3, // Teknologi
                'title' => 'The Pragmatic Programmer',
                'author' => 'David Thomas & Andrew Hunt',
                'publisher' => 'Addison-Wesley',
                'year' => 2019,
                'stock' => 6,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
