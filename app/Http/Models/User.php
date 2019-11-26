<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'u_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
