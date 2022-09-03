<?php

namespace App\Models\Project;

use App\Traits\Model\FormatTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, FormatTrait;

    /**
     * 模型的数据库连接名
     *
     * @var string
     */
    protected $connection = 'backend';

    /**
     * 与模型关联的数据表.
     *
     * @var string
     */
    protected $table = 'project';
}
