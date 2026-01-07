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

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
                return $this->image;
            }
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }
        
        return 'https://placehold.co/400x400';
    }
}
