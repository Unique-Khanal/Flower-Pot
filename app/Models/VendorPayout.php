<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayout extends Model
{
    protected $fillable = [
        'vendor_id',
        'total_sales',
        'commission_deducted',
        'payout_amount',
        'status',
        'period_start',
        'period_end',
        'paid_at',
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'paid_at' => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}