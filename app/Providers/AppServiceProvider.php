<?php

namespace App\Providers;

use App\Models\CommissionNegotiation;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('year', date('Y'));

        // Shared across every page using the admin shell, so the top-bar
        // bell/mail badges show real counts regardless of which admin
        // controller rendered the page — avoids "undefined variable"
        // errors on pages that don't explicitly pass these.
        View::composer('layouts.admin', function ($view) {
            $view->with([
                'navAlertCount' => Vendor::where('status', 'pending')->count()
                    + CommissionNegotiation::where('status', 'pending')
                        ->where('proposed_by', 'vendor')->count(),
                'navUnreadContacts' => Contact::where('is_read', false)->count(),
                'navPendingProducts' => Product::whereNotNull('vendor_id')
                    ->where('is_hidden', true)->whereNull('hidden_reason')->count(),
            ]);
        });
    }
}