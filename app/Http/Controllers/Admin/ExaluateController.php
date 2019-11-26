<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Model\exaluateModel;
use App\Http\Models\exaluateModel;

class ExaluateController extends Controller
{
    //评价添加
    public function exalute_add()
    {
        $query = request()->all();
        $course_id = $query['course_id'];
        //dd($course_id);
        return view('admin.exaluate.exaluate_add',compact('course_id'));
    }

    //处理评论添加
    public function exaluate_doadd(Request $request)
    {

        $content=request()->all();
        //dd($content);
        $user = $request->session()->get('user');
        $u_id = $user->id;
        //dd($u_id);
        // $redis = new \Redis();
        // $redis->connect('127.0.0.1','6379');
        // $redis->incr('number');
        // $num=$redis->get('number');
        //  echo $num;die;  点赞个数
        $course_id = $content['course_id'];
        $data=[
            'course_id'=>$course_id,
            'u_id'=>$u_id,
            'e_content'=>$content['e_content'],
            'create_time'=>time(),
        ];
        $res=exaluateModel::create($data);

        if($res){
            return redirect("/admin/exalute_index?u_id=$u_id&course_id=$course_id");
        }

    }


    public function exalute_index()
    {
        $query = request()->all();
        //dd($query);
        $user = request()->session()->get('user');
        $u_id = $user->id;
        //dd($u_id);
        $info=exaluateModel::where(['is_del'=>1,'course_id'=>$query['course_id'],'u_id'=>$u_id])->get()->toArray();
        return view('admin.exaluate.exalute_index',['info'=>$info]);
    }


    //软删除
    public  function exalute_del(Request $request)
    {
        $id=request('id');
        // var_dump($id);die;
        $res=exaluateModel::where('e_id',$id)->update(['is_del'=>2]);
        if($res){
            echo json_encode(['content'=>'删除成功','icon'=>6,'code'=>1]);
        }else{
            echo json_encode(['content'=>'删除失败','icon'=>5,'code'=>2]);
        }

    }
}
