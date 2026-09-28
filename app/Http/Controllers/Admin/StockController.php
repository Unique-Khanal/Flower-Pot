<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockAdjustment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /** Same threshold the vendor dashboard uses for "low stock". */
    public const LOW_STOCK = 5;

    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');   // all | in | low | out
        $owner  = $request->query('owner', 'all');    // all | platform | vendor
        $search = trim((string) $request->query('search', ''));

        $query = Product::with('vendor')->orderBy('stock')->orderBy('name');

        match ($filter) {
            'out'   => $query->where('stock', '<=', 0),
            'low'   => $query->where('stock', '>', 0)->where('stock', '<=', self::LOW_STOCK),
            'in'    => $query->where('stock', '>', self::LOW_STOCK),
            default => null,
        };

        match ($owner) {
            'platform' => $query->whereNull('vendor_id'),
            'vendor'   => $query->whereNotNull('vendor_id'),
            default    => null,
        };

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('vendor', fn ($v) => $v->where('business_name', 'like', "%{$search}%"));
            });
        }

        $products = $query->paginate(25)->withQueryString();

        $stats = [
            'products' => Product::count(),
            'units'    => (int) Product::sum('stock'),
            'low'      => Product::where('stock', '>', 0)->where('stock', '<=', self::LOW_STOCK)->count(),
            'out'      => Product::where('stock', '<=', 0)->count(),
        ];

        $recent = StockAdjustment::with(['product', 'user'])->latest()->limit(15)->get();

        return view('admin.stock.index', [
            'products' => $products,
            'stats'    => $stats,
            'recent'   => $recent,
            'filter'   => $filter,
            'owner'    => $owner,
            'search'   => $search,
            'lowStock' => self::LOW_STOCK,
        ]);
    }

    /**
     * Admin sets the real stock for ANY product (platform or vendor-owned).
     * The change is logged, and the vendor sees the new number on their side
     * because it's the same products.stock column.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'new_stock' => ['required', 'integer', 'min:0', 'max:1000000'],
            'reason'    => ['required', 'string', 'max:255'],
        ]);

        $old = (int) $product->stock;

        $product->setStock((int) $data['new_stock'], $data['reason'], 'admin');

        if ((int) $product->stock === $old) {
            return back()->with('success', "Stock for {$product->name} is unchanged ({$old}).");
        }

        return back()->with('success', "Stock for {$product->name} updated: {$old} → {$product->stock}.");
    }
}