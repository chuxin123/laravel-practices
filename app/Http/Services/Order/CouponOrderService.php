<?php

namespace App\Http\Services\Order;

use App\Http\Services\Order\Contracts\ICouponOrder;
use App\Repositories\Order\CouponOrderRepository;

class CouponOrderService implements ICouponOrder
{
    public function __construct(
        private readonly CouponOrderRepository $couponOrderRepository
    )
    {
    }

    public function createPreOrder(array $order, array $subOrders)
    {
        return true;
    }

    public function orderDetail(string $orderNo): array
    {
        return [];
    }

    public function orderList($request): array
    {
        return [];
    }
}
