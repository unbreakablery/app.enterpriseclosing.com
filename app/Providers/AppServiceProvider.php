<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\OutboundUsertable;
use App\View\Components\OutboundUsertableRow;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('outbound-usertable', OutboundUsertable::class);
        Blade::component('outbound-usertable-row', OutboundUsertableRow::class);
    }
}
