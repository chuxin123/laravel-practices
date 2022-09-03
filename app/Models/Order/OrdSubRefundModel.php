<?php

namespace App\Models\Order;


use App\Traits\Model\FormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdSubRefundModel extends Model
{
    use HasFactory, FormatTrait;

    /**
     * 模型的数据库连接名
     *
     * @var string
     */
    protected $connection = 'center_order';

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'ord_sub_refund';

    /**
     * 是否主动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
