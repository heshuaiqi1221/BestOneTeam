<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Users;
use App\Library\Response;
use App\Validate\ModifyPwdValidate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Models\Activity;
use App\Http\Models\Information;
use App\Http\Models\Course;

class ActivityController extends Controller
{
    //精彩活动添加
    public function activity_add(Request $request){
        $data = Course::where(['close'=>2])->get();
        return view('admin.activity.activity_add',compact(['data']));
    }

    //精彩活动执行添加
    public function activity_add_do(Request $request){
        $data = $request->input();
        $data['act_time']=time();
        $data['act_hot']='33';
        $activityinfo=Activity::where(['act_title'=>$data['act_title']])->first();
        if($data['act_title']==$activityinfo['act_title']){
            $data=[
                'code'=>402,
                'message'=>'活动已存在，请勿重新添加',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $res =Activity::insert($data);
            $data=[
                'code'=>200,
                'message'=>'活动添加成功',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }

    }

    public function information_list(){

        // echo "访问次数".$info_hot;
        $date = Information::where(['is_del'=>1])->paginate(2);
        // dd($date);
        return view('admin.information.list',['date'=>$date,'info_hot'=>$info_hot]);
    }

    //精彩活动执行列表
    public function activity_list(Request $request){
        // 访问次数(热度、浏览次数)
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('act_hot');
        $act_hot = $redis->get('act_hot');
        //dd($act_hot);
        $data =Activity::join('Course','Activity.course_id','=','Course.course_id')->where(['Activity.is_del'=>1])->get();
        return view('admin.activity.activity_list',['data'=>$data,'act_hot'=>$act_hot]);
    }

    //精彩活动删除
    public function activity_destroy(Request $request){
        $act_id = request()->act_id;
        //修改状态
        $res =Activity::where(['act_id'=>$act_id])->update(['is_del'=>2]);
        if($res){
            header("Refresh:2,url=/admin/activity_list");
            die("删除成功,2秒后自动跳到展示页面");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/activity_list'</script>");
        }
        $res =Activity::where(['act_id'=>$act_id])->update(['is_del'=>2]);
    }

    public function activity_update(Request $request){
        $data1 = Course::where(['close'=>2])->get();
        $data = $request->all();
        $res = Activity::where(['act_id'=>$data['act_id']])->get()->toArray();
        return view('admin.activity.activity_update',['res'=>$res,'data1'=>$data1]);
    }

    public function activity_update_do(Request $request){
        $data = $request->all();
        $res = Activity::where(['act_id'=>$data['act_id']])->update
        (['act_title'=>$data['act_title'],'act_content'=>$data['act_content']]);
        if($res){
            $data = [
                'code'=>200,
                'message'=>'修改成功',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data = [
                'code'=>403,
                'message'=>'修改失败',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }


}