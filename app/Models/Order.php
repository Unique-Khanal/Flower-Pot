<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer_name', 'email', 'phone_no',
        'address', 'latitude', 'longitude',
        'distance_km', 'delivery_charge',
        'subtotal', 'coupon_id', 'discount_amount', 'total', 'status',
        'payment_method', 'payment_status', 'gateway_ref',
        'refund_amount', 'refund_reason', 'refunded_at', 'refunded_by',
        'cancel_reason', 'cancelled_at',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
        'refunded_at'  => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function refundedBy()
    {
        return $this->belongsTo(User::class, 'refunded_by');
    }
}
