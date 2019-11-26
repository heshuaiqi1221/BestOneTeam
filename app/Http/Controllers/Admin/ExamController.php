<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Exam;
use App\Http\Models\Course;
use App\Http\Models\User;
class ExamController extends Controller
{
    //考试添加
    public function exam_add(Request $request){
        $course_id = $request->course_id;
        return view('admin.exam.exam_add',compact(['course_id']));
    }

    //考试执行添加
    public function exam_add_do(Request $request){
        $data['course_id'] = $request->course_id;
        $data = $request->input();
        $user = $request->session()->get('user');
        $data['u_id'] = $user->id;
        $data['exam_time']=time();
        $data['exam_num']='33';
        $Exam_Info =Exam::where(['exam_title'=>$data['exam_title']])->first();
        if($data['exam_title']==$Exam_Info['exam_title']){
            $data=[
                'code'=>402,
                'message'=>'考试指导标题已存在，请重新添加',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $res =Exam::insert($data);
            $data=[
                'code'=>200,
                'message'=>'success',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }

    //考试列表
    public function exam_list(Request $request){
        $course_id = request()->id;
        // 访问次数(热度、浏览次数)
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('exam_num');
        $exam_num = $redis->get('exam_num');
        $data =Exam::join("Course","Course.course_id","=","Exam.course_id")->join("User","User.u_id","=","Exam.u_id")->where(['Exam.is_del'=>1,'Exam.course_id'=>$course_id])->get();
        //dd($data);
        return view('admin.exam.exam_list',compact(['data','exam_num']));
    }

    //删除考试内容
    public function exam_destroy(Request $request){
        $course_id = $request->course_id;
        $exam_id = request()->exam_id;
        $res = Exam::where(['exam_id'=>$exam_id])->update(['is_del'=>2]);
        if($res){
            header("Refresh:2,url=/admin/exam_list?id=".$course_id);
            die("删除成功,2秒后自动跳到展示页面");
        }else{
            echo ("<script>alert('删除失败,系统错误');location='/admin/exam_list?id=".$course_id."'</script>");
        }
    }

    //修改考试内容
    public function exam_update(Request $request){
        $course_id = $request->course_id;
        $data = $request->all();
        $res = Exam::where(['exam_id'=>$data['exam_id']])->get()->toArray();
        return view('admin.exam.exam_update',compact(['res','course_id']));
    }

    //执行修改考试内容
    public function exam_update_do(Request $request){
        $data = $request->all();
        $res = Exam::where(['exam_id'=>$data['exam_id']])->update(['exam_title'=>$data['exam_title'],'exam_content'=>$data['exam_content']]);
        if($res){
            $data=[
                'code'=>200,
                'message'=>'修改成功',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data=[
                'code'=>401,
                'message'=>'修改失败',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }


}