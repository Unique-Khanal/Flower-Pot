<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'vendor_id', 'name', 'description', 'image', 'price',
        'category', 'size',
        'quantity', 'stock',
        'badge', 'is_hidden', 'hidden_reason',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'is_hidden' => 'boolean',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function isPlatformOwned(): bool
    {
        return is_null($this->vendor_id);
    }
}
