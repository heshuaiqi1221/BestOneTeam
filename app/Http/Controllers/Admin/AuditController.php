<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Course;
use App\Http\Models\User;
use App\Library\Response;
use App\Validate\ModifyPwdValidate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\questionsModel;
class AuditController extends Controller
{
    public function course_audit()
    {
        $course = Course::join("Lect","Course.lect_id","=","Lect.lect_id")->where('Course.close','!=',1)->where(['Course.is_del'=>1])->paginate(3);
        //dd($course);
        return view('admin.audit.course_audit',compact('course'));
    }

    public function course_audit_close()
    {
        $post = request()->all();
        if (empty($post['course_id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data = Course::where(['course_id'=>$post['course_id']])->update(['close'=>$post['close']]);
            return json_encode(['code'=>2,'msg'=>'操作成功']);
        }
    }

    public function lect_audit()
    {
        $lect = User::join("user_info","User.u_id","=","user_info.u_id")->where('User.is_status',1)->where('User.lect','!=',1)->paginate(3);
        $name = $_SERVER['SERVER_NAME'];
        //dd($lect);
        return view('admin.audit.lect_audit',compact('lect','name'));
    }

    public function lect_audit_close()
    {
        $post = request()->all();
        if (empty($post['u_id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data = User::where(['u_id'=>$post['u_id']])->update(['lect'=>$post['lect']]);
            return json_encode(['code'=>2,'msg'=>'审核成功']);
        }
    }
}
