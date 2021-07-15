<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\OutboundUsertable;
use App\View\Components\OutboundUsertableRow;
use App\View\Components\Opportunity;
use App\View\Components\Script;
use App\View\Components\Email;

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
        Blade::component('opportunity', Opportunity::class);
        Blade::component('script', Script::class);
        Blade::component('email', Email::class);
    }
}
