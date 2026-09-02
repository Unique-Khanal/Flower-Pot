<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    public function pots()
    {
        return view('products.pots.index');
    }

    public function ceramics()
    {
        $products = Product::where('category', 'ceramics')
                           ->where('is_hidden', false)
                           ->orderByRaw("FIELD(size, 'large', 'medium', 'small')")
                           ->orderBy('name')
                           ->get()
                           ->groupBy('size');
        return view('products.pots.ceramics', compact('products'));
    }

    public function cement()
    {
        $products = Product::where('category', 'cement')
                           ->where('is_hidden', false)
                           ->orderByRaw("FIELD(size, 'large', 'medium', 'small')")
                           ->orderBy('name')
                           ->get()
                           ->groupBy('size');
        return view('products.pots.cement', compact('products'));
    }

    public function mud()
    {
        $products = Product::where('category', 'mud')
                           ->where('is_hidden', false)
                           ->orderBy('name')
                           ->get();
        return view('products.pots.mud', compact('products'));
    }

    public function plastic()
    {
        $products = Product::where('category', 'plastic')
                           ->where('is_hidden', false)
                           ->orderByRaw("FIELD(size, 'large', 'medium', 'small')")
                           ->orderBy('name')
                           ->get()
                           ->groupBy('size');
        return view('products.pots.plastic', compact('products'));
    }

    public function plants()
    {
        $products = Product::where('category', 'plants')
                           ->where('is_hidden', false)
                           ->orderBy('name')
                           ->get();
        return view('products.plants', compact('products'));
    }

    public function show(Product $product)
    {
        // A hidden/pending-review product is only viewable by the vendor
        // who owns it (previewing their own pending listing) or an admin —
        // never by the general public, even with a direct link.
        if ($product->is_hidden) {
            $user = Auth::user();
            $isOwner = $user && $user->vendor && $user->vendor->id === $product->vendor_id;
            $isAdmin = $user && $user->role === 'admin';

            abort_unless($isOwner || $isAdmin, 404);
        }

        return view('products.show', compact('product'));
    }
}