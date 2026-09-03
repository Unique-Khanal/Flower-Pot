<?php

namespace App\Providers;

use App\Models\CommissionNegotiation;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;
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

        // Same reasoning for the vendor shell — $vendor and $stats are used
        // directly in the sidebar/header (business name, pending-order
        // badge). Sharing them here means any vendor controller that
        // extends layouts.vendor works automatically, without needing to
        // remember to pass 'vendor' and 'stats' from every single action.
        // A controller can still override 'stats' by passing its own —
        // Blade uses whichever was set last, and $view->with() here runs
        // before the controller's explicit view data is merged in.
        View::composer('layouts.vendor', function ($view) {
            $user = Auth::user();

            if (! $user || ! $user->vendor) {
                return;
            }

            $vendor = $user->vendor;

            $view->with([
                'vendor' => $vendor,
                'stats'  => [
                    'pending_orders' => $vendor->orderItems()
                        ->where('vendor_status', 'pending')->count(),
                ],
            ]);
        });
    }
}