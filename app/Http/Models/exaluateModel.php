<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class exaluateModel extends Model
{
    protected $table = 'exaluate';
    protected $primaryKey = 'e_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
