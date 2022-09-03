<?php

namespace App\Providers;

use App\Http\Services\Order\CouponOrderService;
use App\Http\Services\Order\FoodOrderService;
use App\Http\Services\Order\HotelOrderService;
use App\Http\Services\Order\HotelSelfOperatedOrderService;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Order\SpaOrderService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class BusinessServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 延迟加载单例
        $this->app->singleton(HotelOrderService::class);
        $this->app->singleton(CouponOrderService::class);
        $this->app->singleton(FoodOrderService::class);
        $this->app->singleton(SpaOrderService::class);
        $this->app->singleton(OrderService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * 获取服务提供者的服务
     *
     * @return array
     */
    public function provides()
    {
        return [
            HotelOrderService::class,
            CouponOrderService::class,
            FoodOrderService::class,
            SpaOrderService::class,
            OrderService::class,
        ];
    }
}
