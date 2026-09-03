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
    public const CATEGORIES = ['plants', 'ceramics', 'cement', 'mud', 'plastic'];
    public const MAX_IMAGES = 5;

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

        $paths = $this->storeUploadedImages($request);

        $this->vendor()->products()->create([
            ...$validated,
            'image'          => $paths[0],
            'gallery_images' => array_slice($paths, 1),
            'is_hidden'      => true,
            'hidden_reason'  => null,
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

        if ($request->hasFile('images')) {
            // Replace the whole photo set — delete every old file first.
            foreach ($product->allImages() as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            $paths = $this->storeUploadedImages($request);
            $validated['image']          = $paths[0];
            $validated['gallery_images'] = array_slice($paths, 1);
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

        foreach ($product->allImages() as $path) {
            Storage::disk('public')->delete($path);
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
            'images'      => [$updating ? 'nullable' : 'required', 'array', 'min:1', 'max:' . self::MAX_IMAGES],
            'images.*'    => ['image', 'max:4096'],
        ], [
            'images.required' => 'Please upload at least one photo.',
            'images.max'      => 'You can upload up to ' . self::MAX_IMAGES . ' photos.',
        ]);
    }

    /**
     * @return string[] storage paths, first element is always the primary/thumbnail image
     */
    private function storeUploadedImages(Request $request): array
    {
        return collect($request->file('images'))
            ->map(fn ($file) => $file->store('products', 'public'))
            ->values()
            ->all();
    }
}