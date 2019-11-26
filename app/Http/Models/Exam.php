<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $primaryKey = 'exam_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
