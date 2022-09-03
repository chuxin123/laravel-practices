<?php

namespace App\Repositories\Order;

use App\Models\Order\CenterCouponOrderModel;

class CouponOrderRepository
{
    public function __construct()
    {

    }

    public function getOrder(int $id) {
        return CenterCouponOrderModel::where('id', '=', $id)->first();
    }
}
