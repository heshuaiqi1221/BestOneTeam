<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * 与模型关联的表名
     * @var string
     */
    protected $table = 'note';

    // 设置主键id
    protected $primaryKey = "note_id";

    /**
     * 指示模型是否自动维护时间戳
     * @var bool
     */
    public $timestamps = false;
    protected $guarded = [];
}
