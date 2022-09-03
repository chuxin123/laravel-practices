<?php

namespace App\Models\Order;

use App\Traits\Model\FormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterCouponOrderModel extends Model
{
    use HasFactory, FormatTrait;
    /**
     * 模型的数据库连接名
     *
     * @var string
     */
    protected $connection = 'backend';

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'center_coupon_order';

    /**
     * 是否主动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;


}
