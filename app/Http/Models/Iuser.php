<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Iuser extends Model
{
    protected $table = 'i_user';
    protected $primaryKey = "uid";
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
