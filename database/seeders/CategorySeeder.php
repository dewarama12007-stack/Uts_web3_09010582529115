<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fiksi',
                'description' => 'Buku-buku fiksi termasuk novel, cerpen, dan karya sastra imajinatif lainnya.',
            ],
            [
                'name' => 'Non-Fiksi',
                'description' => 'Buku-buku non-fiksi berisi informasi faktual seperti biografi, sejarah, dan sains.',
            ],
            [
                'name' => 'Teknologi',
                'description' => 'Buku-buku tentang teknologi, pemrograman, dan ilmu komputer.',
            ],
            [
                'name' => 'Manga & Komik',
                'description' => 'Koleksi serial komik dan manga Jepang populer dari berbagai genre.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
