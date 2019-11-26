<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * 与模型关联的表名
     * @var string
     */
    protected $table = 'job';

    // 设置主键id
    protected $primaryKey = "job_id";

    /**
     * 指示模型是否自动维护时间戳
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = [];//批量添加需要的指定属性
}
