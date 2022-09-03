<?php

namespace App\Http\Services\Order;

use App\Http\Services\Order\Contracts\IHotelOrder;
use App\Repositories\Order\HotelOrderRepository;
use App\Repositories\Order\OrderRepository;


class HotelOrderService implements IHotelOrder
{

    public function __construct(
        private readonly HotelOrderRepository   $hotelOrderRepository,
        private readonly OrderRepository        $orderRepository
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
