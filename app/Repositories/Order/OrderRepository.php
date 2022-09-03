<?php

namespace App\Repositories\Order;

use App\Enums\IndustryEnum;
use App\Models\Order\OrdOrderDiscountModel;
use App\Models\Order\OrdOrderLogModel;
use App\Models\Order\OrdOrderModel;
use App\Models\Order\OrdSubOrderModel;
use App\Models\Order\SysMessageTemplateModel;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * Get email template
     * @param $scenesType
     * @param $templateType
     * @return string
     */
    public function getEmailTemplate($scenesType, $templateType):string
    {
        $data = SysMessageTemplateModel::where("template_scenes", "=", $scenesType)
            ->where("template_type", "=", $templateType)
            ->first();
        return $data->template_content;
    }

    public function updateOrder(array $attributes = [], array $options = []){
        return OrdOrderModel::update($attributes, $options);
    }

    public function updateSubOrder(array $attributes = [], array $options = []){
        return OrdSubOrderModel::update($attributes, $options);
    }


}
