<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Job;
use App\Http\Models\Course;
use App\Http\Models\Catelog;
class JobController extends Controller
{
    public function job_add()
    {
        $id = request()->id;
        $course_id = request()->course_id;
        //dd($query);
        if($id=='' || $course_id==''){
            echo ("<script>alert('参数错误');location='/admin/index'</script>");
        }
        return view('admin.job.add',compact('id','course_id'));
    }

    // 添加作业
	public function job_add_do(Request $request){
    	$date=$request->all();
        //dd($date);
        $date['cou_id'] = $date['cou_id'];//课程id
        $date['catelog_id'] = $date['catelog_id'];//章节id
        $date['create_time'] = time();
        if(empty($date['job_name']) || empty($date['job_content'])){
        	echo ("<script>alert('请输入完整信息');location='/admin/job/job_add?course_id=".$date['cou_id']."&id=".$date['catelog_id']."'</script>");exit;
        }
        $res = Job::insert($date);
        if($res){
    		echo ("<script>alert('添加成功,跳转到列表页面');location='/admin/job/job_list?course_id=".$date['cou_id']."&id=".$date['catelog_id']."'</script>");
    	}else{
    		echo ("<script>alert('添加失败,系统错误');location='/admin/job/job_add?course_id=".$date['cou_id']."&id=".$date['catelog_id']."'</script>");
    	}
    }
    // 作业列表
    public function job_list(){
        $query=request()->all();
        //dd($query);
        if(empty($query)) {
            return redirect("/admin/index");exit;
        }
        //dd($query);
        $date = Job::join('Course','Job.cou_id','=','Course.course_id')
        ->join('Catalog','Job.catelog_id','=','Catalog.catelog_id')
        ->where(['Job.cou_id'=>$query['course_id']])
        ->where(['Job.catelog_id'=>$query['id']])
        ->where(['Job.job_del'=>1])
        ->paginate(2);
        //dd($date);
        return view('admin.job.list',['date'=>$date,'query'=>$query]);
    }
    // 删除作业(软删除)
    public function job_del(Request $request){
        $job_id = $request->all()['job_id'];
        $id = $request->all()['id'];
        $course_id = $request->all()['course_id'];
        //dd()
        if($id=='' || $course_id==''){
            echo ("<script>alert('参数错误');location='/admin/index'</script>");
        }
        //修改状态
        $date = Job::where(['job_id'=>$job_id])->update(['job_del'=>2]);
        if($date){
            return redirect("/admin/job/job_list?id=".$id."&course_id=".$course_id);

        }
    }
    // 作业修改
    public function job_update(Request $request){
        $id = request()->id;
        $course_id = request()->course_id;
        if($id=='' || $course_id==''){
            echo ("<script>alert('参数错误');location='/admin/index'</script>");
        }
        $job_id = $request->all()['job_id'];
        $info = Job::where(['job_id'=>$job_id])->first();
        return view('admin.job.update',['info'=>$info,'id'=>$id,'course_id'=>$course_id]);
    }

    // 作业修改执行
    public function job_update_do(Request $request){
        $data = $request->all();
        //dd($data);
        $res = Job::where(['job_id'=>$data['job_id']])->update([
            'job_name' => $data['job_name'],
            'job_content' => $data['job_content'],
        ]);
        if($res){
            echo ("<script>alert('修改成功,跳转到列表页面');location='/admin/job/job_list?course_id=".$data['cou_id']."&id=".$data['catelog_id']."'</script>");
        }else{
            echo ("<script>alert('修改失败,系统错误');location='/admin/job/job_update?job_id=".$data['job_id']."&course_id=".$data['cou_id']."&id=".$data['catelog_id']."'</script>");
        }

    }
}
