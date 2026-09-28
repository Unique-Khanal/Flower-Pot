<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'vendor_id', 'name', 'description', 'image', 'gallery_images', 'price',
        'category', 'size',
        'quantity', 'stock',
        'badge', 'is_hidden', 'hidden_reason',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'is_hidden'      => 'boolean',
        'gallery_images' => 'array',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Change stock by a delta (+/-) and write an audit-log row.
     * Re-reads the row under a lock so concurrent changes can't clobber each other.
     */
    public function adjustStock(int $delta, string $reason, string $source = 'order'): void
    {
        $this->applyStock(fn (int $old) => $old + $delta, $reason, $source);
    }

    /** Set stock to an exact number (admin correction) and log the difference. */
    public function setStock(int $newStock, string $reason, string $source = 'admin'): void
    {
        $this->applyStock(fn (int $old) => $newStock, $reason, $source);
    }

    private function applyStock(callable $calc, string $reason, string $source): void
    {
        DB::transaction(function () use ($calc, $reason, $source) {
            $locked = static::whereKey($this->getKey())->lockForUpdate()->first();
            if (! $locked) {
                return;
            }

            $old = (int) $locked->stock;
            $new = max(0, (int) $calc($old));

            if ($new === $old) {
                $this->stock = $old;
                return;
            }

            $locked->stock = $new;
            $locked->save();

            StockAdjustment::create([
                'product_id' => $locked->id,
                'user_id'    => Auth::id(),
                'old_stock'  => $old,
                'new_stock'  => $new,
                'change'     => $new - $old,
                'reason'     => $reason,
                'source'     => $source,
            ]);

            $this->stock = $new;
        });
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function isPlatformOwned(): bool
    {
        return is_null($this->vendor_id);
    }

    /**
     * Primary image + gallery combined, in display order — for anywhere
     * the storefront wants to loop over every photo of a product.
     */
    public function allImages(): array
    {
        return array_filter(array_merge([$this->image], $this->gallery_images ?? []));
    }
}