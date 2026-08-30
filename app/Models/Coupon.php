<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'type', 'value', 'min_order_total',
        'usage_limit', 'times_used', 'starts_at', 'expires_at',
        'is_active', 'created_by',
    ];

    protected $casts = [
        'starts_at'  => 'datetime',
        'expires_at' => 'datetime',
        'is_active'  => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
