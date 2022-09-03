<?php

namespace App\Factories;

use App\Enums\IndustryEnum;
use App\Http\Services\Order\CouponOrderService;
use App\Http\Services\Order\FoodOrderService;
use App\Http\Services\Order\HotelOrderService;
use App\Http\Services\Order\OrderService;
use App\Http\Services\Order\SpaOrderService;

final class OrderFactory
{
    public static function make($industryCode = "")
    {
        switch ($industryCode) {
            case IndustryEnum::HOTEL->getCode():
                $orderFactory = app()->make(HotelOrderService::class);
                break;
            case IndustryEnum::COUPON->getCode():
                $orderFactory = app()->make(CouponOrderService::class);
                break;
            case IndustryEnum::FOOD->getCode():
                $orderFactory = app()->make(FoodOrderService::class);
                break;
            case IndustryEnum::SPA->getCode():
                $orderFactory = app()->make(SpaOrderService::class);
                break;
        };
        return $orderFactory;
    }
}
