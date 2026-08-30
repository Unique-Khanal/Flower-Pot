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
        'pan_number',
        'pan_document',
        'logo',
        'sample_product_photos',
        'commission_rate',
        'status',
        'rejection_reason',
        'bank_account_no',
        'bank_name',
        'approved_at',
        'reviewed_by',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'commission_rate' => 'decimal:2',
        'sample_product_photos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
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

    public function commissionNegotiations()
    {
        return $this->hasMany(CommissionNegotiation::class)->latest();
    }

    public function pendingNegotiation()
    {
        return $this->hasOne(CommissionNegotiation::class)
            ->where('status', 'pending')
            ->latestOfMany();
    }
}
