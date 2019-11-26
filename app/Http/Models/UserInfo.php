<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;


class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $primaryKey = 'user_info_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
