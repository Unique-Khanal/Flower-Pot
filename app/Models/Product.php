<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'image', 'price',
        'category', 'size',
        'quantity', 'stock',
        'badge'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }
}
