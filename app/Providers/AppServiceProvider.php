<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // When debug mode is enabled, SQL is logged
        if (env('APP_DEBUG')) {
            DB::listen(function ($query) {
                Log::info("[system_debug][sql_print]", [
                    $query->sql,
                    $query->bindings,
                    $query->time,
                ]);
            });
        }
    }
}
