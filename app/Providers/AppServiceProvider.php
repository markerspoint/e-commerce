<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\ProductLayoutComposer;
use App\View\Composers\SellerSidebarComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register View Composer for product layout
        View::composer('layouts.product', ProductLayoutComposer::class);

        // Register View Composer for seller sidebar
        View::composer('partials.seller-sidebar', SellerSidebarComposer::class);
    }
}
