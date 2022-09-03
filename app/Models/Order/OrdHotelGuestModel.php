<?php

namespace App\Models\Order;


use App\Traits\Model\FormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Utils;
use Illuminate\Database\Eloquent\Model;

class OrdHotelGuestModel extends Model
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
    protected $table = 'ord_hotel_guest';

    /**
     * 是否主动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;
}
