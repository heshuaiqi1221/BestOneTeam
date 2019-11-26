<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $table = 'paper';
    protected $primaryKey = 'paper_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
