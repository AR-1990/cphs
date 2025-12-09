<?php

namespace App\Providers;

use App\Http\Helpers\CustomValidators;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

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
        $this->app->validator->resolver(function($translator, $data, $rules, $messages){
            return new CustomValidators($translator, $data, $rules, $messages);
        });

    }
}
