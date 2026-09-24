<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public const CATEGORIES = ['plants', 'ceramics', 'cement', 'mud', 'plastic'];
    public const MAX_IMAGES = 5;

    /**
     * status = pending/live/hidden: vendor-submitted products, unchanged
     * moderation view.
     *
     * status = platform: products with vendor_id NULL — this covers BOTH
     * the pre-vendor-system catalog (products uploaded before vendors
     * existed) and anything the admin adds directly from here now. These
     * were previously invisible to any admin screen; they're now fully
     * manageable (create/edit/delete), same as a vendor manages their own.
     */
    public function index(Request $request): View
    {
        $status = $request->get('status', 'pending');

        if ($status === 'platform') {
            $pstatus = $request->get('pstatus', 'all');

            $platformQuery = Product::whereNull('vendor_id')->latest();

            $products = match ($pstatus) {
                'live'   => (clone $platformQuery)->where('is_hidden', false)->get(),
                'hidden' => (clone $platformQuery)->where('is_hidden', true)->get(),
                default  => $platformQuery->get(),
            };

            $counts = [
                'pending'  => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNull('hidden_reason')->count(),
                'live'     => Product::whereNotNull('vendor_id')->where('is_hidden', false)->count(),
                'hidden'   => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNotNull('hidden_reason')->count(),
                'platform' => Product::whereNull('vendor_id')->count(),
            ];

            $platformCounts = [
                'all'    => Product::whereNull('vendor_id')->count(),
                'live'   => Product::whereNull('vendor_id')->where('is_hidden', false)->count(),
                'hidden' => Product::whereNull('vendor_id')->where('is_hidden', true)->count(),
            ];

            return view('admin.products.index', compact('products', 'status', 'counts', 'pstatus', 'platformCounts'));
        }

        $query = Product::with('vendor')->whereNotNull('vendor_id')->latest();

        $products = match ($status) {
            'live'    => (clone $query)->where('is_hidden', false)->get(),
            'hidden'  => (clone $query)->where('is_hidden', true)->whereNotNull('hidden_reason')->get(),
            default   => (clone $query)->where('is_hidden', true)->whereNull('hidden_reason')->get(),
        };

        $counts = [
            'pending'  => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNull('hidden_reason')->count(),
            'live'     => Product::whereNotNull('vendor_id')->where('is_hidden', false)->count(),
            'hidden'   => Product::whereNotNull('vendor_id')->where('is_hidden', true)->whereNotNull('hidden_reason')->count(),
            'platform' => Product::whereNull('vendor_id')->count(),
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

    /**
     * ── Admin-owned product CRUD (vendor_id NULL) ──────────────────
     * The admin sells directly, same as a vendor, minus the
     * review/approval step — a product the admin creates or edits here
     * goes straight live, since the admin IS the approver.
     */

    public function create(): View
    {
        return view('admin.products.create', ['categories' => self::CATEGORIES]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        $paths = $this->storeUploadedImages($request);

        Product::create([
            ...$validated,
            'vendor_id'      => null,
            'image'          => $paths[0],
            'gallery_images' => array_slice($paths, 1),
            'is_hidden'      => false,
            'hidden_reason'  => null,
        ]);

        return redirect()->route('admin.products.index', ['status' => 'platform'])
            ->with('success', 'Product added and live on the storefront.');
    }

    public function edit(Product $product): View
    {
        $this->authorizePlatformProduct($product);

        return view('admin.products.edit', ['product' => $product, 'categories' => self::CATEGORIES]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $this->authorizePlatformProduct($product);

        $validated = $this->validated($request, updating: true);

        if ($request->hasFile('images')) {
            foreach ($product->allImages() as $oldPath) {
                Storage::disk('public')->delete($this->toDiskPath($oldPath));
            }

            $paths = $this->storeUploadedImages($request);
            $validated['image']          = $paths[0];
            $validated['gallery_images'] = array_slice($paths, 1);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index', ['status' => 'platform'])
            ->with('success', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorizePlatformProduct($product);

        foreach ($product->allImages() as $path) {
            Storage::disk('public')->delete($this->toDiskPath($path));
        }

        $product->delete();

        return redirect()->route('admin.products.index', ['status' => 'platform'])
            ->with('success', 'Product removed.');
    }

    /**
     * Create/edit/delete here are only for admin-owned/legacy products
     * (vendor_id NULL). A vendor-owned product must go through the
     * vendor's own controller and the moderation flow above — an admin
     * editing a vendor's listing directly would bypass that vendor's
     * ownership and the review trail entirely.
     */
    private function authorizePlatformProduct(Product $product): void
    {
        abort_unless($product->vendor_id === null, 403);
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

    private function storeUploadedImages(Request $request): array
    {
        return collect($request->file('images'))
            ->map(fn ($file) => 'storage/' . $file->store('products', 'public'))
            ->values()
            ->all();
    }

    private function toDiskPath(string $publicPath): string
    {
        return str_starts_with($publicPath, 'storage/')
            ? substr($publicPath, strlen('storage/'))
            : $publicPath;
    }
}