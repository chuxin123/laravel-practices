<?php

namespace App\Http\Services\Order\Contracts;

interface IOrder
{
    /**
     * 创建订单接口
     *
     * @param createOrderReq 订单信息
     * @param project        项目
     *
     * @return 返回值
     */
    public function createPreOrder(array $order, array $subOrders);

    public function orderDetail(string $orderNo);

    public function orderList($request);
}
