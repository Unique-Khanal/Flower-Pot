<?php

namespace App\Http\Controllers;

use App\Models\Product;

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
        $products = [
            'large'  => Product::where('category', 'ceramics')->where('size', 'large')->get(),
            'medium' => Product::where('category', 'ceramics')->where('size', 'medium')->get(),
            'small'  => Product::where('category', 'ceramics')->where('size', 'small')->get(),
        ];
        return view('products.pots.ceramics', compact('products'));
    }

    public function cement()
    {
        $products = [
            'large'  => Product::where('category', 'cement')->where('size', 'large')->get(),
            'medium' => Product::where('category', 'cement')->where('size', 'medium')->get(),
            'small'  => Product::where('category', 'cement')->where('size', 'small')->get(),
        ];
        return view('products.pots.cement', compact('products'));
    }

    public function mud()
    {
        $products = Product::where('category', 'mud')->inRandomOrder()->get();
        return view('products.pots.mud', compact('products'));
    }

    public function plastic()
    {
        $products = [
            'large'  => Product::where('category', 'plastic')->where('size', 'large')->get(),
            'medium' => Product::where('category', 'plastic')->where('size', 'medium')->get(),
            'small'  => Product::where('category', 'plastic')->where('size', 'small')->get(),
        ];
        return view('products.pots.plastic', compact('products'));
    }

    public function plants()
    {
        $products = Product::where('category', 'plants')->get();
        return view('products.plants', compact('products'));
    }
}

