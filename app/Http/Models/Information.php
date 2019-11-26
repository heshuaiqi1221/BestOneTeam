<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{

    protected $table = 'information';
    protected $primaryKey = 'info_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
