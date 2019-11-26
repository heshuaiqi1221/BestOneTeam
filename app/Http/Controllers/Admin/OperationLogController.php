<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\OperationLog;
class OperationLogController extends Controller
{
    public function index()
    {
        $data = OperationLog::get()->toArray();
        return view('admin.operation.index',['data'=>$data]);
    }

    public function del()
    {
        $id = request()->id;
        //dd($id);
        $del = OperationLog::where(['id'=>$id])->delete();
        if($del){
            return redirect('/admin/operationLog/index');
        }
    }
}