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
        $catFiksi = \App\Models\Category::where('name', 'Fiksi')->first();
        $catNonFiksi = \App\Models\Category::where('name', 'Non-Fiksi')->first();
        $catTekno = \App\Models\Category::where('name', 'Teknologi')->first();
        $catManga = \App\Models\Category::where('name', 'Manga & Komik')->first();

        $books = [
            // --- Kategori: Fiksi ---
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'stock' => 15,
            ],
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Hasta Mitra',
                'year' => 1980,
                'stock' => 8,
            ],
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'year' => 2017,
                'stock' => 14,
            ],
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2002,
                'stock' => 9,
            ],
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Hujan',
                'author' => 'Tere Liye',
                'publisher' => 'Republika Penerbit',
                'year' => 2016,
                'stock' => 16,
            ],
            [
                'category_id' => $catFiksi?->id ?? 1,
                'title' => 'Negeri 5 Menara',
                'author' => 'A. Fuadi',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2009,
                'stock' => 11,
            ],

            // --- Kategori: Non-Fiksi ---
            [
                'category_id' => $catNonFiksi?->id ?? 2,
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'Harper',
                'year' => 2011,
                'stock' => 12,
            ],
            [
                'category_id' => $catNonFiksi?->id ?? 2,
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'publisher' => 'Penerbit Buku Kompas',
                'year' => 2019,
                'stock' => 18,
            ],
            [
                'category_id' => $catNonFiksi?->id ?? 2,
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'publisher' => 'Gramedia Pustaka Utama',
                'year' => 2019,
                'stock' => 20,
            ],
            [
                'category_id' => $catNonFiksi?->id ?? 2,
                'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
                'author' => 'Mark Manson',
                'publisher' => 'Grasindo',
                'year' => 2018,
                'stock' => 13,
            ],
            [
                'category_id' => $catNonFiksi?->id ?? 2,
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'publisher' => 'Harriman House',
                'year' => 2020,
                'stock' => 10,
            ],

            // --- Kategori: Teknologi ---
            [
                'category_id' => $catTekno?->id ?? 3,
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'stock' => 10,
            ],
            [
                'category_id' => $catTekno?->id ?? 3,
                'title' => 'The Pragmatic Programmer',
                'author' => 'David Thomas & Andrew Hunt',
                'publisher' => 'Addison-Wesley',
                'year' => 2019,
                'stock' => 6,
            ],
            [
                'category_id' => $catTekno?->id ?? 3,
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'author' => 'Martin Fowler',
                'publisher' => 'Addison-Wesley',
                'year' => 2018,
                'stock' => 8,
            ],
            [
                'category_id' => $catTekno?->id ?? 3,
                'title' => 'Designing Data-Intensive Applications',
                'author' => 'Martin Kleppmann',
                'publisher' => "O'Reilly Media",
                'year' => 2017,
                'stock' => 11,
            ],
            [
                'category_id' => $catTekno?->id ?? 3,
                'title' => 'Clean Architecture',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2017,
                'stock' => 9,
            ],

            // --- Kategori: Manga & Komik ---
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'One Piece Vol. 100',
                'author' => 'Eiichiro Oda',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2022,
                'stock' => 25,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Naruto Vol. 72',
                'author' => 'Masashi Kishimoto',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2015,
                'stock' => 16,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Attack on Titan Vol. 34',
                'author' => 'Hajime Isayama',
                'publisher' => 'Level Comics',
                'year' => 2021,
                'stock' => 12,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Jujutsu Kaisen Vol. 01',
                'author' => 'Gege Akutami',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2021,
                'stock' => 18,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Spy x Family Vol. 01',
                'author' => 'Tatsuya Endo',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2020,
                'stock' => 22,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Frieren: Beyond Journey\'s End Vol. 01',
                'author' => 'Kanehito Yamada & Tsukasa Abe',
                'publisher' => 'm&c!',
                'year' => 2022,
                'stock' => 15,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Demon Slayer: Kimetsu no Yaiba Vol. 01',
                'author' => 'Koyoharu Gotouge',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2020,
                'stock' => 20,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Detective Conan Vol. 100',
                'author' => 'Gosho Aoyama',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2022,
                'stock' => 14,
            ],
            [
                'category_id' => $catManga?->id ?? ($catFiksi?->id ?? 1),
                'title' => 'Blue Lock Vol. 01',
                'author' => 'Muneyuki Kaneshiro & Yusuke Nomura',
                'publisher' => 'Elex Media Komputindo',
                'year' => 2022,
                'stock' => 17,
            ],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }
}
