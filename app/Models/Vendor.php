<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'user_id',
        'business_name',
        'business_phone',
        'business_address',
        'logo',
        'commission_rate',
        'status',
        'bank_account_no',
        'bank_name',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'commission_rate' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payouts()
    {
        return $this->hasMany(VendorPayout::class);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}