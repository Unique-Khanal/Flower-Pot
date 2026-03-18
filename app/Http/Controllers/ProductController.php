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
        $products = Product::where('category', 'ceramics')
                           ->orderBy('size')->orderBy('name')
                           ->get()->groupBy('size');
        return view('products.pots.ceramics', compact('products'));
    }

    public function cement()
    {
        $products = Product::where('category', 'cement')
                           ->orderBy('size')->orderBy('name')
                           ->get()->groupBy('size');
        return view('products.pots.cement', compact('products'));
    }

    public function mud()
    {
        $products = Product::where('category', 'mud')
                           ->orderBy('name')->get();
        return view('products.pots.mud', compact('products'));
    }

    public function plastic()
    {
        $products = Product::where('category', 'plastic')
                           ->orderBy('size')->orderBy('name')
                           ->get()->groupBy('size');
        return view('products.pots.plastic', compact('products'));
    }

    public function plants()
    {
        $products = Product::where('category', 'plants')
                           ->orderBy('name')->get();
        return view('products.plants', compact('products'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}