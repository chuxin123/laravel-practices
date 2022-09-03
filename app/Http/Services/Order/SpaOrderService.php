<?php

namespace App\Http\Services\Order;

use App\Http\Services\Order\Contracts\ISpaOrder;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\SpaOrderRepository;

class SpaOrderService implements ISpaOrder
{

    public function __construct(
        private readonly SpaOrderRepository $spaOrderRepository,
        private readonly OrderRepository    $orderRepository
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
