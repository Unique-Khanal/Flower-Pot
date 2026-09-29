<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'vendor_id',
        'vendor_status', 'commission_amount', 'vendor_payout_id',
        'product_name', 'product_image',
        'price', 'quantity', 'subtotal',
    ];

    /**
     * Where this product is in its journey, for the customer's tracker.
     * 0 = cancelled, 1 = placed, 2 = confirmed, 3 = preparing (vendor),
     * 4 = shipped (vendor), 5 = delivered.
     */
    public function trackingStep(?Order $order = null): int
    {
        $order ??= $this->order;

        if ($this->vendor_status === 'cancelled' || $order->status === 'cancelled') {
            return 0;
        }

        if ($order->status === 'delivered' || $this->vendor_status === 'delivered') {
            return 5;
        }

        return match ($this->vendor_status) {
            'shipped'    => 4,
            'processing' => 3,
            default      => $order->status === 'confirmed' ? 2 : 1,
        };
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function payout()
    {
        return $this->belongsTo(VendorPayout::class, 'vendor_payout_id');
    }
}