<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomepageAndCatalogTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);
    }

    public function test_homepage_loads_successfully_with_dynamic_viral_products(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('PRODUK YANG LAGI VIRAL');
        $response->assertSee('Minyak goreng');
        $response->assertSee('Gula pasir');
        $response->assertSee('Tepung terigu');
        $response->assertSee('IDR 11.500');
    }

    public function test_homepage_does_not_display_inactive_products(): void
    {
        // Deactivate Minyak goreng
        $minyak = Product::where('slug', 'minyak-goreng')->first();
        $minyak->update(['is_active' => false]);

        $response = $this->get('/');

        $response->assertStatus(200);
        // Should not see the inactive product in viral list
        $response->assertDontSee($minyak->name);
    }

    public function test_catalog_page_loads_successfully_with_products_and_categories(): void
    {
        $response = $this->get('/belanja');

        $response->assertStatus(200);
        $response->assertSee('Sembako Pokok');
        $response->assertSee('Banyak jenis pilihan lain');

        // Check products in Section 1 (Sembako Pokok)
        $response->assertSee('Beras');
        $response->assertSee('Garam');

        // Check products in Section 2 (Other categories)
        $response->assertSee('Mie instan');
        $response->assertSee('Kecap manis');
        $response->assertSee('Saus tomat');
        $response->assertSee('Kopi sachet');
        $response->assertSee('Sabun mandi');
    }

    public function test_catalog_page_excludes_inactive_products(): void
    {
        $beras = Product::where('slug', 'beras')->first();
        $beras->update(['is_active' => false]);

        $response = $this->get('/belanja');

        $response->assertStatus(200);
        $response->assertDontSee('Beras');
    }

    public function test_navigation_routes_are_all_accessible(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/belanja')->assertStatus(200);
        $this->get('/pelayanan')->assertStatus(200);
        $this->get('/keranjang')->assertStatus(200);
        $this->get('/checkout')->assertStatus(200);
        $this->get('/tentang-kami')->assertStatus(200);
        $this->get('/kontak')->assertStatus(200);
    }
}
