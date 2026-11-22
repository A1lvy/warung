<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function belanja()
    {
        return view('pages.belanja');
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
