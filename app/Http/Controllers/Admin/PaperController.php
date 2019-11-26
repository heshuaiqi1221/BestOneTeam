<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Question_answer;
use App\Http\Models\Question_problem;
use App\Http\Models\Question_type;
use App\Http\Models\Category;
use App\Http\Models\Paper;
class PaperController extends Controller
{
    //添加
    public function index_add()
    {
        $category=new Category();
        $data =$category->get()->toArray();
        $date=Question_problem::get()->toarray();
//        dd($data,$date);
        return view('/admin/paper/index_add',['data'=>$data,'date'=>$date]);
    }
    public function add_do(Request $request)
    {
        $post = request()->all();
//        dd($post);
        $cate_id=$post['cate_id'];
        $paper_name=$post['paper_name'];
        $single=$post['single'];
        $problem= implode("|", $single);
        $add_time=time();
        $add=Paper::insert([
            'cate_id'=>$cate_id,
            'paper_name'=>$paper_name,
            'problem_id'=>$problem,
            'add_time'=>$add_time
        ]);
//        dd('11');
        if($add){
            return redirect('/admin/paper/pa_list');
        }
    }

    public function pa_list()
    {
        $data=Paper::
        leftJoin('category','category.cate_id','=','paper.cate_id')
            ->get()->toarray();
//        dd($data);

        return view('/admin/paper/pa_list',['data'=>$data]);
    }

    public  function  list_de(Request $request)
    {
        $post = request()->all();
//        dd($post);
        $problem_id=$post['id'];
        $is_yes=strtr($problem_id,'|',",");
        $problem_id=explode('|',$problem_id);
//    dd($problem_id);
        $date=Question_problem::
        leftJoin('question_answer','question_answer.question_id','=','question_problem.id')
            ->wherein('question_problem.id',$problem_id)->get()->groupBy('question_answer.question_id');
        $date=json_decode(json_encode($date),1);
        $list = array();
        foreach($date[""] as $key=>$val){
            $list[$val['question_id']]['id'] = $val['question_id'];
            $list[$val['question_id']]['type_id'] = $val['type_id'];
            $list[$val['question_id']]['data'][] = $val;

        }

        $ret = array();

        foreach ($list as $key => $value) {
            array_push($ret, $value);
        }
        return view('/admin/paper/list_de',['data'=>$ret,'is_yes'=>$is_yes]);
    }

    public function pa_del(Request $request)
    {
        $req=$request->all();
//        dd($req);
        $where=['paper_id'=>$req['id']];
        $del=Paper::where($where)->delete();
        return redirect('/admin/paper/pa_list');
    }


}
