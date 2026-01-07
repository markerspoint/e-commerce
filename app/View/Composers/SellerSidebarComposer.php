<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Order;

class SellerSidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $pendingCount = Order::where('status', 'pending')->count();
        $view->with('pendingCount', $pendingCount);
    }
}
