<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Display cart contents.
     */
    public function index(): View
    {
        $cartItems = $this->cartService->getItems();
        $totalQuantity = $this->cartService->getTotalQuantity();
        $totalPrice = $this->cartService->getTotalPrice();
        $formattedTotal = $this->cartService->getFormattedTotalPrice();

        return view('pages.keranjang', [
            'cartItems' => $cartItems,
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'formattedTotal' => $formattedTotal,
        ]);
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        [$success, $message] = $this->cartService->add(
            (int) $validated['product_id'],
            (int) $validated['quantity']
        );

        if (! $success) {
            return back()->with('error', $message);
        }

        return redirect()->route('keranjang')->with('success', $message);
    }

    /**
     * Update product quantity in cart.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $action = $request->input('action');

        if ($action === 'increase') {
            [$success, $message] = $this->cartService->increase($product->id);
        } elseif ($action === 'decrease') {
            [$success, $message] = $this->cartService->decrease($product->id);
        } else {
            $validated = $request->validate([
                'quantity' => ['required', 'integer', 'min:0'],
            ]);
            [$success, $message] = $this->cartService->update($product->id, (int) $validated['quantity']);
        }

        if (! $success) {
            return back()->with('error', $message);
        }

        return back()->with('success', $message);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Product $product): RedirectResponse
    {
        $this->cartService->remove($product->id);

        return back()->with('success', 'Produk ' . $product->name . ' berhasil dihapus dari keranjang.');
    }

    /**
     * Clear entire cart.
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('keranjang')->with('success', 'Keranjang berhasil dikosongkan.');
    }
}
