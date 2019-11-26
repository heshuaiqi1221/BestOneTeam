<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use App\Library\Response;
use App\Validate\ModifyPwdValidate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Collect;
use App\Http\Models\Course;
use App\Http\Models\User;

class CollectController extends Controller
{
    public function collect_add(Request $request){
        $data['course_id']= request()->course_id;
        $data['u_id']= 1;
        $data['f_id']= 1;
        $data['create_time']=time();
        $res = Collect::create($data);
        if($res){
            return redirect('admin/collect_list');
        }
    }

    public function collect_list(Request $request){

        $data =Collect::join('Course','Course.course_id','=','Collect.course_id')->join('User','User.u_id','=','Collect.u_id')->where(['Collect.is_del'=>1])->get();
        //dd($data);
        return view('admin.collect.collect_list',compact(['data']));
    }

    public function collect_destroy(Request $request){
        $collect_id = request()->collect_id;
        //dd($collect_id);
        if(empty($collect_id)){
                alert('请选择一条记录');
        }
        $res =Collect::where(['collect_id'=>$collect_id])->update(['is_del'=>2]);
        if($res){
            return redirect('/admin/collect_list');
        }else{
            return redirect('/admin/collect_list');
        }
    }
}