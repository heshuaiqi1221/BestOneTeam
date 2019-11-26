<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    /**
     * 与模型关联的表名
     * @var string
     */
    protected $table = 'slide';

    // 设置主键id
    protected $primaryKey = "s_id";

    /**
     * 指示模型是否自动维护时间戳
     * @var bool
     */
    public $timestamps = false;

    protected $guarded = [];
}
