<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'icon', 'description', 'featured'];

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected $appends = ['icon_url'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Get the icon URL - returns custom icon, image, or auto-detected default
     */
    public function getIconUrlAttribute()
    {
        // If seller has set a custom icon
        if ($this->icon) {
            // Check if it's a full path or just filename
            if (Str::startsWith($this->icon, ['http', 'https'])) {
                return $this->icon;
            }
            
            // Only return if file actually exists to avoid broken images
            if (file_exists(public_path('icons/' . $this->icon))) {
                return asset('icons/' . $this->icon);
            }
        }

        // If seller has uploaded an image
        if ($this->image) {
            // Handle external URLs (fix for seeders using placeholders)
            if (Str::startsWith($this->image, ['http', 'https'])) {
                // Ignore placeholders so we can show the nice default SVGs instead
                if (Str::contains($this->image, ['placehold.co', 'placeholder.com', 'via.placeholder'])) {
                    return $this->getAutoDetectedIcon();
                }
                return $this->image;
            }
            
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }

        return $this->getAutoDetectedIcon();
    }

    /**
     * Helper to get the auto-detected icon URL
     */
    private function getAutoDetectedIcon()
    {
        return asset('img/category/' . $this->getDefaultIconFilename()) . '?v=2';
    }

    /**
     * Get the card background color based on category
     */
    public function getCardColorAttribute()
    {
        $name = Str::lower($this->name);
        $slug = $this->slug;

        // Map keywords to colors (hex)
        $colorMap = [
            // Electronics (Blue/Indigo)
            'electronic' => '#3b82f6',
            'phone' => '#3b82f6',
            'laptop' => '#3b82f6',
            'computer' => '#3b82f6',
            'gadget' => '#6366f1',
            
            // Fashion (Pink/Purple)
            'fashion' => '#ec4899',
            'clothing' => '#ec4899',
            'wear' => '#d946ef',
            'clothes' => '#d946ef',
            'apparel' => '#ec4899',
            
            // Home & Living (Orange/Amber)
            'home' => '#f59e0b',
            'living' => '#f59e0b',
            'furniture' => '#f97316',
            'decor' => '#d97706',
            
            // Beauty (Rose/Red)
            'beauty' => '#f43f5e',
            'cosmetic' => '#f43f5e',
            'makeup' => '#e11d48',
            'skincare' => '#fb7185',
            
            // Toys (Yellow/Red)
            'toy' => '#ef4444',
            'game' => '#facc15',
            'kid' => '#f59e0b',
            'baby' => '#fbbf24',
            
            // Health (Teal/Green)
            'health' => '#14b8a6',
            'medical' => '#06b6d4',
            'pharmacy' => '#0d9488',
            'care' => '#10b981',
            
            // Sports (Orange/Red)
            'sport' => '#f97316',
            'fitness' => '#ea580c',
            'gym' => '#ef4444',
            'outdoor' => '#f97316',
            
            // Automotive (Gray/Blue)
            'auto' => '#3b82f6',
            'car' => '#2563eb',
            'vehicle' => '#475569',
            'motor' => '#64748b',

            // Food & Groceries (Greens, Reds, Oranges)
            'vegetable' => '#22c55e',
            'fruit' => '#ef4444', 
            'meat' => '#dc2626',
            'fish' => '#3b82f6',
            'milk' => '#06b6d4',
            'dairy' => '#0ea5e9',
            'snack' => '#f59e0b',
            'bread' => '#d97706',
            'beverage' => '#0ea5e9',
            'drink' => '#3b82f6',
            'frozen' => '#60a5fa',
            
            // Organic
            'organic' => '#65a30d',
            'natural' => '#84cc16',
        ];

        // Check if any keyword matches
        foreach ($colorMap as $keyword => $color) {
            if (Str::contains($name, $keyword) || Str::contains($slug, $keyword)) {
                return $color;
            }
        }

        // Default fallback (Primary Green)
        return '#00b207';
    }

    /**
     * Get default icon filename based on category name keywords
     */
    public function getDefaultIconFilename()
    {
        $name = Str::lower($this->name);
        $slug = $this->slug;
        
        // ... (rest of the method)
        $iconMap = [
            // Electronics
            'electronic' => 'electronics.svg',
            'phone' => 'electronics.svg',
            'laptop' => 'electronics.svg',
            'computer' => 'electronics.svg',
            'gadget' => 'electronics.svg',
            
            // Fashion
            'fashion' => 'fashion.svg',
            'clothing' => 'fashion.svg',
            'wear' => 'fashion.svg',
            'clothes' => 'fashion.svg',
            'apparel' => 'fashion.svg',
            
            // Home & Living
            'home' => 'home-living.svg',
            'living' => 'home-living.svg',
            'furniture' => 'home-living.svg',
            'decor' => 'home-living.svg',
            
            // Beauty
            'beauty' => 'beauty.svg',
            'cosmetic' => 'beauty.svg',
            'makeup' => 'beauty.svg',
            'skincare' => 'beauty.svg',
            
            // Toys
            'toy' => 'toys.svg',
            'game' => 'toys.svg',
            'kid' => 'toys.svg',
            'baby' => 'toys.svg',
            
            // Health
            'health' => 'health.svg',
            'medical' => 'health.svg',
            'pharmacy' => 'health.svg',
            'care' => 'health.svg',
            'medicine' => 'health.svg',
            
            // Sports
            'sport' => 'sports.svg',
            'fitness' => 'sports.svg',
            'gym' => 'sports.svg',
            'outdoor' => 'sports.svg',
            
            // Automotive
            'auto' => 'automotive.svg',
            'car' => 'automotive.svg',
            'vehicle' => 'automotive.svg',
            'motor' => 'automotive.svg',

            // Food & Groceries 
            'vegetable' => 'vegetables.svg',
            'fruit' => 'fruits.svg',  
            'meat' => 'meat-fish.svg', 
            'fish' => 'meat-fish.svg',
            'milk' => 'milk-dairy.svg', 
            'dairy' => 'milk-dairy.svg',
            'snack' => 'snacks-breads.svg', 
            'bread' => 'snacks-breads.svg',
            
            // Additional food keywords
            'veggies' => 'vegetables.svg',
            'greens' => 'vegetables.svg',
            'seafood' => 'meat-fish.svg',
            'chicken' => 'meat-fish.svg',
            'beef' => 'meat-fish.svg',
            'pork' => 'meat-fish.svg',
            'cheese' => 'milk-dairy.svg',
            'egg' => 'milk-dairy.svg',
            'yogurt' => 'milk-dairy.svg',
            'bakery' => 'snacks-breads.svg',
            'cookie' => 'snacks-breads.svg',
            'pastry' => 'snacks-breads.svg',
            'beverage' => 'beverages.svg',
            'drink' => 'beverages.svg',
            'juice' => 'beverages.svg',
            'soda' => 'beverages.svg',
            'coffee' => 'beverages.svg',
            'tea' => 'beverages.svg',
            'water' => 'beverages.svg',
            'frozen' => 'frozen.svg',
            'ice' => 'frozen.svg',
            'household' => 'household.svg',
            'cleaning' => 'household.svg',
            'detergent' => 'household.svg',
            'organic' => 'organic.svg',
            'natural' => 'organic.svg',
            'bio' => 'organic.svg',
        ];

        // Check if any keyword matches
        foreach ($iconMap as $keyword => $icon) {
            if (Str::contains($name, $keyword) || Str::contains($slug, $keyword)) {
                return $icon;
            }
        }

        // Default fallback
        return 'default.svg';
    }
}
