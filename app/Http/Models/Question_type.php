<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Question_type extends Model
{
    protected $table = 'question_type';
    protected $primaryKey = 'type_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
