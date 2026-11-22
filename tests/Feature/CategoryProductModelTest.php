<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryProductModelTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
    }

    public function test_categories_and_products_are_seeded(): void
    {
        $this->assertEquals(3, Category::count());
        $this->assertEquals(10, Product::count());
    }

    public function test_category_has_many_products_relationship(): void
    {
        $category = Category::where('slug', 'sembako-pokok')->first();
        $this->assertNotNull($category);
        $this->assertTrue($category->products()->exists());
        $this->assertInstanceOf(Product::class, $category->products->first());
        $this->assertEquals(5, $category->products()->count());
    }

    public function test_product_belongs_to_category_relationship(): void
    {
        $product = Product::where('slug', 'minyak-goreng')->first();
        $this->assertNotNull($product);
        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals('Sembako Pokok', $product->category->name);
    }

    public function test_model_type_casts(): void
    {
        $product = Product::where('slug', 'minyak-goreng')->first();
        $this->assertNotNull($product);
        $this->assertIsInt($product->price);
        $this->assertIsInt($product->stock);
        $this->assertIsBool($product->is_active);
        $this->assertEquals(11500, $product->price);
    }

    public function test_unique_slug_constraints(): void
    {
        $this->expectException(QueryException::class);

        Category::create([
            'name' => 'Duplicate Category',
            'slug' => 'sembako-pokok',
        ]);
    }
}
