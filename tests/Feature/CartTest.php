<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\CartService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    protected Product $product;
    protected Product $secondProduct;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CategorySeeder::class);
        $this->seed(ProductSeeder::class);

        $this->product = Product::where('slug', 'minyak-goreng')->first();
        $this->secondProduct = Product::where('slug', 'gula-pasir')->first();
    }

    public function test_1_adding_a_product_to_cart(): void
    {
        $response = $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('keranjang'));
        $response->assertSessionHas('success');
        $this->assertEquals([$this->product->id => 2], session('cart'));
    }

    public function test_2_adding_the_same_product_multiple_times_merges_quantity(): void
    {
        $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 3,
        ]);

        $this->assertEquals([$this->product->id => 5], session('cart'));
    }

    public function test_3_updating_product_quantity(): void
    {
        session(['cart' => [$this->product->id => 2]]);

        // Increase action
        $response = $this->patch(route('cart.update', $this->product->id), [
            'action' => 'increase',
        ]);
        $response->assertSessionHas('success');
        $this->assertEquals([$this->product->id => 3], session('cart'));

        // Decrease action
        $this->patch(route('cart.update', $this->product->id), [
            'action' => 'decrease',
        ]);
        $this->assertEquals([$this->product->id => 2], session('cart'));

        // Direct quantity set
        $this->patch(route('cart.update', $this->product->id), [
            'quantity' => 5,
        ]);
        $this->assertEquals([$this->product->id => 5], session('cart'));
    }

    public function test_4_removing_an_item_from_cart(): void
    {
        session(['cart' => [
            $this->product->id => 2,
            $this->secondProduct->id => 1,
        ]]);

        $response = $this->delete(route('cart.remove', $this->product->id));

        $response->assertSessionHas('success');
        $this->assertEquals([$this->secondProduct->id => 1], session('cart'));
    }

    public function test_5_rejecting_inactive_products(): void
    {
        $this->product->update(['is_active' => false]);

        $response = $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 1,
        ]);

        $response->assertSessionHas('error');
        $this->assertEmpty(session('cart', []));
    }

    public function test_6_rejecting_quantities_exceeding_available_stock(): void
    {
        $this->product->update(['stock' => 5]);

        $response = $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 10,
        ]);

        $response->assertSessionHas('error');
        $this->assertEmpty(session('cart', []));

        // When updating quantity above stock
        session(['cart' => [$this->product->id => 3]]);
        $responseUpdate = $this->patch(route('cart.update', $this->product->id), [
            'quantity' => 6,
        ]);
        $responseUpdate->assertSessionHas('error');
        $this->assertEquals([$this->product->id => 3], session('cart'));
    }

    public function test_7_correct_subtotal_and_total_calculations(): void
    {
        session(['cart' => [
            $this->product->id => 2,
            $this->secondProduct->id => 3,
        ]]);

        $cartService = app(CartService::class);
        $this->assertEquals(57500, $cartService->getTotalPrice());
        $this->assertEquals('IDR 57.500', $cartService->getFormattedTotalPrice());

        $response = $this->get(route('keranjang'));
        $response->assertStatus(200);
        $response->assertSee('IDR 23.000');
        $response->assertSee('IDR 34.500');
        $response->assertSee('IDR 57.500');
    }

    public function test_8_empty_cart_behavior(): void
    {
        session()->forget('cart');

        $response = $this->get(route('keranjang'));

        $response->assertStatus(200);
        $response->assertSee('Keranjang Belanja Kosong');
        $response->assertSee('Mulai Belanja');
        $response->assertSee('(0)');
    }

    public function test_9_cart_quantity_indicator_in_navbar_and_cart_page(): void
    {
        session(['cart' => [
            $this->product->id => 2,
            $this->secondProduct->id => 4,
        ]]);

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('6');

        $responseCart = $this->get(route('keranjang'));
        $responseCart->assertStatus(200);
        $responseCart->assertSee('(6)');
    }

    public function test_10_price_integrity_based_on_database_values(): void
    {
        $this->post(route('cart.add'), [
            'product_id' => $this->product->id,
            'quantity' => 1,
            'price' => 1, // tampered price payload
        ]);

        $cartService = app(CartService::class);
        $this->assertEquals(11500, $cartService->getTotalPrice());
        $this->assertEquals('IDR 11.500', $cartService->getFormattedTotalPrice());
    }
}
