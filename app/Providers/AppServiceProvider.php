<?php

namespace App\Providers;

use Ajosav\Blinqpay\Models\PaymentProcessor;
use App\Macros\ResponseMacro;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Response::mixin(new ResponseMacro());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::model('processor', PaymentProcessor::class);

        Route::bind('processor', function ($value) {
            return PaymentProcessor::where('slug', $value)->firstOrFail();
        });
    }
}
