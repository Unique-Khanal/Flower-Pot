<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommissionNegotiation extends Model
{
    protected $fillable = [
        'vendor_id',
        'proposed_by',
        'proposed_rate',
        'message',
        'status',
        'responded_by',
        'responded_at',
    ];

    protected $casts = [
        'proposed_rate' => 'decimal:2',
        'responded_at'  => 'datetime',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function respondedByUser()
    {
        return $this->belongsTo(User::class, 'responded_by');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}