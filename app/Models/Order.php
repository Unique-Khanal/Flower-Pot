<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'customer_name', 'email', 'phone_no',
        'address', 'latitude', 'longitude',
        'distance_km', 'delivery_charge',
        'subtotal', 'total', 'status',
        'cancel_reason', 'cancelled_at',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
