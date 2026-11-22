<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartService
{
    protected const SESSION_KEY = 'cart';

    /**
     * Get raw cart data from session [productId => quantity].
     */
    public function getRawCart(): array
    {
        return session()->get(self::SESSION_KEY, []);
    }

    /**
     * Get detailed cart items with database product models and calculated subtotals.
     * Inactive or missing products are automatically cleaned from the session.
     */
    public function getItems(): Collection
    {
        $rawCart = $this->getRawCart();

        if (empty($rawCart)) {
            return collect();
        }

        $products = Product::whereIn('id', array_keys($rawCart))
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $items = collect();
        $staleDetected = false;

        foreach ($rawCart as $productId => $quantity) {
            $product = $products->get($productId);

            if (! $product) {
                unset($rawCart[$productId]);
                $staleDetected = true;
                continue;
            }

            $validQuantity = (int) $quantity;
            if ($validQuantity < 1) {
                unset($rawCart[$productId]);
                $staleDetected = true;
                continue;
            }

            if ($validQuantity > $product->stock) {
                $validQuantity = $product->stock;
                if ($validQuantity < 1) {
                    unset($rawCart[$productId]);
                    $staleDetected = true;
                    continue;
                }
                $rawCart[$productId] = $validQuantity;
                $staleDetected = true;
            }

            $subtotal = $product->price * $validQuantity;

            $items->push([
                'product' => $product,
                'quantity' => $validQuantity,
                'subtotal' => $subtotal,
                'formatted_subtotal' => 'IDR ' . number_format($subtotal, 0, ',', '.'),
            ]);
        }

        if ($staleDetected) {
            session()->put(self::SESSION_KEY, $rawCart);
        }

        return $items;
    }

    /**
     * Get total quantity of items in cart.
     */
    public function getTotalQuantity(): int
    {
        $rawCart = $this->getRawCart();
        if (empty($rawCart)) {
            return 0;
        }

        return $this->getItems()->sum('quantity');
    }

    /**
     * Get overall cart total price in Indonesian Rupiah.
     */
    public function getTotalPrice(): int
    {
        return $this->getItems()->sum('subtotal');
    }

    /**
     * Get formatted overall cart total price.
     */
    public function getFormattedTotalPrice(): string
    {
        return 'IDR ' . number_format($this->getTotalPrice(), 0, ',', '.');
    }

    /**
     * Add a product to the cart with specified quantity.
     *
     * @return array{0: bool, 1: string} [success, message]
     */
    public function add(int $productId, int $quantity = 1): array
    {
        if ($quantity < 1) {
            return [false, 'Jumlah produk minimal 1.'];
        }

        $product = Product::find($productId);

        if (! $product || ! $product->is_active) {
            return [false, 'Produk tidak ditemukan atau sedang tidak aktif.'];
        }

        if ($product->stock < 1) {
            return [false, 'Stok produk ' . $product->name . ' sedang habis.'];
        }

        $rawCart = $this->getRawCart();
        $currentQty = (int) ($rawCart[$productId] ?? 0);
        $newQty = $currentQty + $quantity;

        if ($newQty > $product->stock) {
            return [false, 'Jumlah pesanan melebihi stok yang tersedia (sisa stok: ' . $product->stock . ').'];
        }

        $rawCart[$productId] = $newQty;
        session()->put(self::SESSION_KEY, $rawCart);

        return [true, $product->name . ' berhasil ditambahkan ke keranjang.'];
    }

    /**
     * Update product quantity in cart.
     *
     * @return array{0: bool, 1: string} [success, message]
     */
    public function update(int $productId, int $quantity): array
    {
        $rawCart = $this->getRawCart();

        if (! isset($rawCart[$productId])) {
            return [false, 'Produk tidak ada di dalam keranjang.'];
        }

        if ($quantity <= 0) {
            $this->remove($productId);
            return [true, 'Produk berhasil dihapus dari keranjang.'];
        }

        $product = Product::find($productId);

        if (! $product || ! $product->is_active) {
            $this->remove($productId);
            return [false, 'Produk tidak tersedia dan telah dihapus dari keranjang.'];
        }

        if ($quantity > $product->stock) {
            return [false, 'Jumlah melebihi stok yang tersedia (sisa stok: ' . $product->stock . ').'];
        }

        $rawCart[$productId] = $quantity;
        session()->put(self::SESSION_KEY, $rawCart);

        return [true, 'Jumlah ' . $product->name . ' diperbarui.'];
    }

    /**
     * Increment product quantity by 1.
     *
     * @return array{0: bool, 1: string} [success, message]
     */
    public function increase(int $productId): array
    {
        $rawCart = $this->getRawCart();
        $current = (int) ($rawCart[$productId] ?? 0);

        return $this->update($productId, $current + 1);
    }

    /**
     * Decrement product quantity by 1.
     *
     * @return array{0: bool, 1: string} [success, message]
     */
    public function decrease(int $productId): array
    {
        $rawCart = $this->getRawCart();
        $current = (int) ($rawCart[$productId] ?? 0);

        return $this->update($productId, $current - 1);
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(int $productId): void
    {
        $rawCart = $this->getRawCart();
        unset($rawCart[$productId]);
        session()->put(self::SESSION_KEY, $rawCart);
    }

    /**
     * Clear all items from cart.
     */
    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }
}
