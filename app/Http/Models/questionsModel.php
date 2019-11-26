<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class questionsModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'issue_id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
