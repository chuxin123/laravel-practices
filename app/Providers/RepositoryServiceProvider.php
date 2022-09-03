<?php

namespace App\Providers;

use App\Repositories\Order\CouponOrderRepository;
use App\Repositories\Order\FoodOrderRepository;
use App\Repositories\Order\HotelOrderRepository;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\RefundRepository;
use App\Repositories\Order\SpaOrderRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Item\CommonProductRepository;
use App\Repositories\Item\HotelProductRepository;
use App\Repositories\Item\HotelRatePlanRepository;
use App\Repositories\Item\StoreRepository;
use App\Repositories\Project\ProjectRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * 所有需要注册的容器单例
     *
     * @var array
     */
    public $singletons = [
        ProjectRepository::class,

        HotelOrderRepository::class,
        CouponOrderRepository::class,
        OrderRepository::class,
        SpaOrderRepository::class,
        FoodOrderRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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
}
