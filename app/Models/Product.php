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
        'gallery',
        'is_active',
        'is_new',
        'is_bestseller',
        'is_featured',
        'discount_percentage',
        'rating',
        'review_count',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
        'is_new' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_product');
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

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/placeholder.svg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $filename = basename($this->image);

        // List of directories inside public/
        $directories = [
            'images/products/img_product_chat/',
            'images/products/img_product_chien/',
            'images/products/img_product_oiseau/',
            'images/products/img_product_peigon/',
            'images/products/img_product_poisson/',
            'images/products/',
            'storage/products/',
            'products/'
        ];

        foreach ($directories as $dir) {
            if (file_exists(public_path($dir . $filename))) {
                return asset($dir . $filename);
            }
        }

        // Default fallbacks
        if (str_starts_with($this->image, 'storage/') || str_starts_with($this->image, 'images/')) {
            return asset($this->image);
        }

        return asset('storage/' . $this->image);
    }
}
