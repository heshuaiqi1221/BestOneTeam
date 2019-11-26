<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\responModel;
use App\Http\Models\questionsModel;
use App\Http\Models\Lect;
class QuestionController extends Controller
{
    //添加问题
    public function question_add()
    {
        return view('admin.questions.questions_add');
    }

    public function question_doadd(Request $request)
    {

        //      $redis = new \Redis();
        // $redis->connect('127.0.0.1','6379');
        //   	$redis->incr('number');
        // $num=$redis->get('number');
        //  echo $num;die;


        // $num= Redis::incr("num");
        //  $aa=Redis::set("pass_num_".$ip,$num+1);

        $name=request('name');
        $res=questionsModel::insert([
            'title'=>$name,
            'u_id'=>1,//用户id
            'course_id'=>1,//课程id
            'browse'=>1,//浏览次数
            'is_del'=>1,//软删除。1为未删除 ，2为已删除
            'time'=>time(),
        ]);
        if($res){
            echo json_encode(['content'=>'添加成功','icon'=>6,'code'=>1]);
        }else{
            echo json_encode(['content'=>'添加失败','icon'=>5,'code'=>2]);
        }


    }

    //问题列表展示
    //问题列表可以回答问题
    public function question_list()
    {
        $info=questionsModel::join('Course','questions.course_id','=','Course.course_id')->where('questions.is_del',1)->get()->toArray();
        return view('admin.questions.questions_list',['info'=>$info]);
    }

    //检验问题的一致性
    public function question_nameOnly(Request $request)
    {
        $name=request('name');
        $count=questionsModel::where('title',$name)->count();
        if($count<1){
            echo json_encode(['content'=>'该问题可以使用','icon'=>6,'code'=>1]);
        }else{
            echo json_encode(['content'=>'题库已存在该问题','icon'=>5,'code'=>2]);
        }
    }


    //问题答案入库
    public function resposen_add(Request $request)
    {
        $info=$request->all();
        $info['time']=time();
        //dd($info);
        $res=responModel::create($info);
        if($res){
            echo json_encode(['content'=>'提交成功','icon'=>6,'code'=>1]);
        }else{
            echo json_encode(['content'=>'提交失败,请重新提交','icon'=>5,'code'=>2]);
        }
    }


    //删除问题
    public function questions_del(Request $request)
    {
        $issue_id=request('issue_id');
        // var_dump($issue_id);die;
        $res=questionsModel::where('issue_id',$issue_id)->update(['is_del'=>2]);
        if($res){
            echo json_encode(['content'=>'删除成功','icon'=>6,'code'=>1]);
        }else{
            echo json_encode(['content'=>'删除失败','icon'=>5,'code'=>2]);
        }
    }





}

