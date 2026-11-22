<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sembakoCat = Category::where('slug', 'sembako-pokok')->first();
        $bumbuCat = Category::where('slug', 'bumbu-makanan')->first();
        $rumahCat = Category::where('slug', 'kebutuhan-rumah-tangga')->first();

        $products = [
            // Pilihan sembako pokok
            [
                'category_id' => $sembakoCat?->id,
                'name' => 'Minyak goreng',
                'slug' => 'minyak-goreng',
                'description' => 'Minyak goreng kelapa sawit higienis untuk kebutuhan dapur sehari-hari.',
                'price' => 11500,
                'unit' => 'liter',
                'stock' => 50,
                'image_path' => 'images/product-hero.png',
                'is_active' => true,
            ],
            [
                'category_id' => $sembakoCat?->id,
                'name' => 'Gula pasir',
                'slug' => 'gula-pasir',
                'description' => 'Gula pasir kristal putih berkualitas dengan rasa manis alami.',
                'price' => 11500,
                'unit' => 'kg',
                'stock' => 50,
                'image_path' => 'images/product-hero.png',
                'is_active' => true,
            ],
            [
                'category_id' => $sembakoCat?->id,
                'name' => 'Tepung terigu',
                'slug' => 'tepung-terigu',
                'description' => 'Tepung terigu serbaguna cocok untuk aneka olahan kue dan gorengan.',
                'price' => 11500,
                'unit' => 'kg',
                'stock' => 50,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
            [
                'category_id' => $sembakoCat?->id,
                'name' => 'Beras',
                'slug' => 'beras',
                'description' => 'Beras pulen bersih pilihan keluarga.',
                'price' => 11500,
                'unit' => 'kg',
                'stock' => 100,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
            [
                'category_id' => $sembakoCat?->id,
                'name' => 'Garam',
                'slug' => 'garam',
                'description' => 'Garam beryodium halus pelengkap rasa masakan.',
                'price' => 11500,
                'unit' => 'pcs',
                'stock' => 80,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],

            // Pilihan lain (Bumbu & Makanan)
            [
                'category_id' => $bumbuCat?->id,
                'name' => 'Mie instan',
                'slug' => 'mie-instan',
                'description' => 'Mie instan kuah/goreng lezat dan praktis.',
                'price' => 11500,
                'unit' => 'pcs',
                'stock' => 120,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
            [
                'category_id' => $bumbuCat?->id,
                'name' => 'Kecap manis',
                'slug' => 'kecap-manis',
                'description' => 'Kecap manis kental gurih dari kedelai hitam pilihan.',
                'price' => 11500,
                'unit' => 'botol',
                'stock' => 40,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
            [
                'category_id' => $bumbuCat?->id,
                'name' => 'Saus tomat',
                'slug' => 'saus-tomat',
                'description' => 'Saus tomat segar rasa asam manis seimbang.',
                'price' => 11500,
                'unit' => 'botol',
                'stock' => 35,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
            [
                'category_id' => $bumbuCat?->id,
                'name' => 'Kopi sachet',
                'slug' => 'kopi-sachet',
                'description' => 'Kopi bubuk instan mantap beraroma khas.',
                'price' => 11500,
                'unit' => 'renteng',
                'stock' => 50,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],

            // Pilihan lain (Kebutuhan Rumah Tangga)
            [
                'category_id' => $rumahCat?->id,
                'name' => 'Sabun mandi',
                'slug' => 'sabun-mandi',
                'description' => 'Sabun mandi pembersih tubuh aroma segar.',
                'price' => 11500,
                'unit' => 'pcs',
                'stock' => 60,
                'image_path' => 'images/product-card.png',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            if ($product['category_id']) {
                Product::updateOrCreate(
                    ['slug' => $product['slug']],
                    $product
                );
            }
        }
    }
}
