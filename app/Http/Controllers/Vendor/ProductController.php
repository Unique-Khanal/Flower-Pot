<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Categories are a plain string column (no DB enum), matching the
     * public ProductController's existing five categories exactly so a
     * vendor's product lands in the same storefront section a customer
     * already browses.
     */
    public const CATEGORIES = ['plants', 'ceramics', 'cement', 'mud', 'plastic'];

    private function vendor()
    {
        return Auth::user()->vendor;
    }

    public function index(): View
    {
        $products = $this->vendor()->products()->latest()->get();

        return view('vendor.products.index', compact('products'));
    }

    public function create(): View
    {
        return view('vendor.products.create', ['categories' => self::CATEGORIES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $imagePath = $request->file('image')->store('products', 'public');

        $this->vendor()->products()->create([
            ...$validated,
            'image'     => $imagePath,
            // New listings need admin sign-off before they're visible to
            // customers — same pattern as vendor applications themselves.
            'is_hidden'     => true,
            'hidden_reason' => null,
        ]);

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product submitted! It will appear on the storefront once an admin reviews it.');
    }

    public function edit(Product $product): View
    {
        $this->authorizeOwner($product);

        return view('vendor.products.edit', ['product' => $product, 'categories' => self::CATEGORIES]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->authorizeOwner($product);

        $validated = $this->validated($request, updating: true);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Anything that changes what the customer actually sees/pays goes
        // back to admin for a fresh review, rather than silently updating
        // an already-approved listing.
        $validated['is_hidden'] = true;
        $validated['hidden_reason'] = null;

        $product->update($validated);

        return redirect()->route('vendor.products.index')
            ->with('success', 'Product updated and resubmitted for admin review.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorizeOwner($product);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Product removed.');
    }

    private function authorizeOwner(Product $product): void
    {
        abort_unless($product->vendor_id === $this->vendor()->id, 403);
    }

    private function validated(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'category'    => ['required', 'in:' . implode(',', self::CATEGORIES)],
            'size'        => ['nullable', 'string', 'in:small,medium,large'],
            'price'       => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'stock'       => ['required', 'integer', 'min:0'],
            'image'       => [$updating ? 'nullable' : 'required', 'image', 'max:4096'],
        ]);
    }
}