<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sembako Pokok',
                'slug' => 'sembako-pokok',
                'description' => 'Bahan pangan pokok utama kebutuhan harian keluarga (beras, minyak, gula, tepung, garam).',
                'is_active' => true,
            ],
            [
                'name' => 'Bumbu & Makanan',
                'slug' => 'bumbu-makanan',
                'description' => 'Bumbu dapur, penyedap rasa, dan makanan cepat saji pelengkap masakan.',
                'is_active' => true,
            ],
            [
                'name' => 'Kebutuhan Rumah Tangga',
                'slug' => 'kebutuhan-rumah-tangga',
                'description' => 'Perlengkapan sanitasi dan kebersihan rumah tangga.',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
