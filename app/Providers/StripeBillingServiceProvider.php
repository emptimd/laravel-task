<?php

namespace App\Providers;

use App\Billing\StripeBilling;
use Illuminate\Support\ServiceProvider;

class StripeBillingServiceProvider extends ServiceProvider
{

//    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StripeBilling::class, function() {
            return new StripeBilling(env('STRIPE_SECRET'));
        });
    }
}
