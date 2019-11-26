<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}

