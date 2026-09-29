<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockAdjustment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StockController extends Controller
{
    public const LOW_STOCK = 5;

    private function vendor()
    {
        return Auth::user()->vendor;
    }

    /** A vendor only ever sees and edits their OWN products. */
    public function index(Request $request): View
    {
        $vendor = $this->vendor();
        $filter = $request->query('filter', 'all');   // all | in | low | out
        $search = trim((string) $request->query('search', ''));

        $query = Product::where('vendor_id', $vendor->id)->orderBy('stock')->orderBy('name');

        match ($filter) {
            'out'   => $query->where('stock', '<=', 0),
            'low'   => $query->where('stock', '>', 0)->where('stock', '<=', self::LOW_STOCK),
            'in'    => $query->where('stock', '>', self::LOW_STOCK),
            default => null,
        };

        if ($search !== '') {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->paginate(20)->withQueryString();

        $mine = Product::where('vendor_id', $vendor->id);
        $stats = [
            'products' => (clone $mine)->count(),
            'units'    => (int) (clone $mine)->sum('stock'),
            'low'      => (clone $mine)->where('stock', '>', 0)->where('stock', '<=', self::LOW_STOCK)->count(),
            'out'      => (clone $mine)->where('stock', '<=', 0)->count(),
        ];

        $recent = StockAdjustment::with(['product', 'user'])
            ->whereHas('product', fn ($q) => $q->where('vendor_id', $vendor->id))
            ->latest()->limit(15)->get();

        return view('vendor.stock.index', [
            'products' => $products,
            'stats'    => $stats,
            'recent'   => $recent,
            'filter'   => $filter,
            'search'   => $search,
            'lowStock' => self::LOW_STOCK,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        abort_unless($product->vendor_id === $this->vendor()->id, 403);

        $data = $request->validate([
            'new_stock' => ['required', 'integer', 'min:0', 'max:1000000'],
            'reason'    => ['required', 'string', 'max:255'],
        ]);

        $old = (int) $product->stock;

        $product->setStock((int) $data['new_stock'], $data['reason'], 'vendor');

        if ((int) $product->stock === $old) {
            return back()->with('success', "Stock for {$product->name} is unchanged ({$old}).");
        }

        return back()->with('success', "Stock for {$product->name} updated: {$old} → {$product->stock}.");
    }
}