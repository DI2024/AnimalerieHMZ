<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'price_old',
        'stock',
        'sku',
        'image',
        'is_active',
        'is_new',
        'is_bestseller',
        'is_featured',
        'discount_percentage',
        'rating',
        'review_count',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function updateRating()
    {
        $this->review_count = $this->reviews()->where('is_approved', true)->count();
        $this->rating = $this->reviews()->where('is_approved', true)->avg('rating') ?: 5.0;
        $this->save();
    }
}
