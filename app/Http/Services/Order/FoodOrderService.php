<?php

namespace App\Http\Services\Order;

use App\Http\Services\Order\Contracts\IFoodOrder;

class FoodOrderService implements IFoodOrder
{
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
