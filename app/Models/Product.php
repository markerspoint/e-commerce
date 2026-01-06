<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 
        'original_price', 'stock', 'sold_count', 'rating', 'image', 'is_flash_sale'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
