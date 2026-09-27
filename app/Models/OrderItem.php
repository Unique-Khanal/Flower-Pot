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