<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class responModel extends Model
{
    protected $table = 'response';
    protected $primaryKey = 'r_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属
}
