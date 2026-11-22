<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $viralProducts = Product::active()
            ->with('category')
            ->take(3)
            ->get();

        return view('pages.home', [
            'viralProducts' => $viralProducts,
        ]);
    }

    public function belanja()
    {
        $categories = Category::active()->with(['products' => function ($query) {
            $query->active();
        }])->get();

        $sembakoCategory = Category::active()->where('slug', 'sembako-pokok')->first();

        $sembakoProducts = $sembakoCategory
            ? $sembakoCategory->products()->active()->take(5)->get()
            : Product::active()->take(5)->get();

        $otherProducts = Product::active()
            ->when($sembakoCategory, function ($query) use ($sembakoCategory) {
                $query->where('category_id', '!=', $sembakoCategory->id);
            })
            ->take(6)
            ->get();

        if ($otherProducts->isEmpty()) {
            $otherProducts = Product::active()->skip(5)->take(6)->get();
        }

        return view('pages.belanja', [
            'categories' => $categories,
            'sembakoCategory' => $sembakoCategory,
            'sembakoProducts' => $sembakoProducts,
            'otherProducts' => $otherProducts,
        ]);
    }

    public function pelayanan()
    {
        return view('pages.pelayanan');
    }

    public function keranjang()
    {
        return view('pages.keranjang');
    }

    public function checkout()
    {
        return view('pages.checkout');
    }

    public function tentangKami()
    {
        return view('pages.tentang-kami');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }
}
