<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class ProductLayoutComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'sidebarCategories' => Category::withCount('products')->get(),
            'totalProductCount' => Product::count(),
        ]);
    }
}
