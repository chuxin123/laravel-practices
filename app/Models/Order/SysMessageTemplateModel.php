<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class SysMessageTemplateModel extends Model
{
    /**
     * 模型的数据库连接名
     *
     * @var string
     */
    protected $connection = 'center_system';

    /**
     * 与模型关联的表名
     *
     * @var string
     */
    protected $table = 'sys_message_template';

    /**
     * 是否主动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

}
