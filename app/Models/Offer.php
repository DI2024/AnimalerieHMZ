<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'badge',
        'image',
        'link',
        'bg_color',
        'is_active',
        'order',
        'type',
        'pack_price',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'pack_price' => 'decimal:2',
    ];

    /**
     * Products associated with this offer/pack
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'offer_product');
    }

    /**
     * Get the total original price of the products in this pack
     */
    public function getTotalOriginalPriceAttribute()
    {
        return $this->products->sum('price');
    }
}
