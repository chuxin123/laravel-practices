<?php

namespace App\Repositories\Order;

use App\Models\Order\OrdSpaOrderModel;

class SpaOrderRepository
{


    /**
     * Get spa order info
     * @param string $orderNo
     * @return array
     */
    public function getOrderInfoByOrderNo(string $orderNo): array
    {
        return OrdSpaOrderModel::where('order_no', '=', $orderNo)
            ->select(
                "start_date",
                "end_date",
                "settlement_price_detail",
                "sale_num",
                "cancel_reason",
                "appointment_date",
                "contact_person",
                "contact_phone"
            )->first();
    }

    /**
     * Get spa order info by sub order no
     * @param string $subOrderNo
     * @return mixed
     */
    public function getSpaOrderInfoBySubOrderNo(string $subOrderNo): mixed
    {
        return OrdSpaOrderModel::where('sub_order_no','=',$subOrderNo)->first();
    }
}
