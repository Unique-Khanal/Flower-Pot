<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Only vendor-submitted products go through moderation — platform-owned
     * products (vendor_id null) were never subject to this gate and are
     * intentionally excluded here.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');

        $query = Product::with('vendor')->whereNotNull('vendor_id')->latest();

        $products = match ($status) {
            'live'    => (clone $query)->where('is_hidden', false)->get(),
            'hidden'  => (clone $query)->where('is_hidden', true)->whereNotNull('hidden_reason')->get(),
            default   => (clone $query)->where('is_hidden', true)->whereNull('hidden_reason')->get(),
        };

        $counts = [
            'pending' => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNull('hidden_reason')->count(),
            'live'    => Product::whereNotNull('vendor_id')->where('is_hidden', false)->count(),
            'hidden'  => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNotNull('hidden_reason')->count(),
        ];

        return view('admin.products.index', compact('products', 'status', 'counts'));
    }

    public function approve(Product $product): RedirectResponse
    {
        $product->update(['is_hidden' => false, 'hidden_reason' => null]);

        return back()->with('success', "{$product->name} is now live on the storefront.");
    }

    public function hide(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'hidden_reason' => ['required', 'string', 'max:500'],
        ]);

        $product->update([
            'is_hidden'     => true,
            'hidden_reason' => $request->hidden_reason,
        ]);

        return back()->with('success', "{$product->name} has been hidden from the storefront.");
    }
}