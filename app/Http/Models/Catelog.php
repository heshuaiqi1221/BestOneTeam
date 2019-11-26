<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Catelog extends Model
{
    protected $table = 'catalog';
    protected $primaryKey = 'catelog_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}