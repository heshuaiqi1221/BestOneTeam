<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Lect extends Model
{
    protected $table = 'lect';
    protected $primaryKey = 'lect_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
