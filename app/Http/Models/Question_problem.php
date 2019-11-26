<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Question_problem extends Model
{
    protected $table = 'question_problem';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
