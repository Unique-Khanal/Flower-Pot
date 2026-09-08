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
        'payment_method', 'payment_status', 'gateway_ref', 'invoice_no',
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

    /**
     * Marks an order as paid and issues its invoice number in the same
     * step — the invoice number only exists once payment is confirmed,
     * whether that's an online gateway callback or an admin marking a
     * COD order as paid on delivery.
     */
    public function markAsPaid(): void
    {
        $this->update([
            'payment_status' => 'paid',
            'invoice_no'     => $this->invoice_no ?? self::nextInvoiceNumber(),
        ]);
    }

    public static function nextInvoiceNumber(): string
    {
        $year = now()->format('Y');

        $lastNumber = self::whereYear('created_at', now()->year)
            ->whereNotNull('invoice_no')
            ->count();

        return sprintf('INV-%s-%06d', $year, $lastNumber + 1);
    }
}