<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $primaryKey = 'act_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
