<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Information;
/**
 * 咨询模块
 */
class InformationController extends Controller
{

    //咨询添加页面
    public function info_add()
    {
        return view('admin.information.add');
    }

    // 咨询添加视图
    public function information_add(Request $request){
        $date=$request->all();
        htmlspecialchars_decode($date['info_content']);
        $user = $request->session()->get('user');
        $date['u_id'] = $user->id;
        //dd($date);
        $date['info_time'] = time();
        if(empty($date['info_title'])){
        	return redirect("/admin/information/info_add");
        }
        //dd($date);
        $res = Information::insert($date);
        if($res){
    		return redirect("/admin/information/info_list");
    	}else{
    		return redirect("/admin/information/info_add");
    	}
    }

    public function information_list(){
    	// 访问次数(热度、浏览次数)
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('info_hot');
        $info_hot = $redis->get('info_hot');
        // echo "访问次数".$info_hot;
        $date = Information::where(['is_del'=>1])->paginate(2);
        htmlspecialchars_decode($date['info_content']);
//         dd($date);
        return view('admin.information.list',['date'=>$date,'info_hot'=>$info_hot]);
    }

    // 咨询删除(软删除)
    public function information_del(Request $request){
        $info_id = $request->all()['info_id'];
        $user = request()->session()->get('user');
        $u_id = $user->id;

        //修改状态
        $date = Information::where(['info_id'=>$info_id,'u_id'=>$u_id])->update(['is_del'=>2]);
        if($date){
            header("Refresh:2,url=/admin/information/info_list");
            die("删除成功,2秒后自动跳到展示页面");
        }else{
        	echo ("<script>alert('添加失败,系统错误');location='/admin/information/info_list'</script>");
        }
    }

    // 咨询修改
    public function information_update(Request $request){
    	$data = $request->all();
    	$info = Information::where(['info_id'=>$data['info_id']])->get()->toArray();
        //dd($info);
    	return view('admin.information.info_update',['info'=>$info]);
    }

    // 咨询修改执行
    public function information_update_do(Request $request){
    	$data = $request->all();
    	$res = Information::where(['info_id'=>$data['info_id']])->update([
    		'info_title' => $data['info_title'],
    		'info_content' => $data['info_content']
    	]);
    	if($res){
            echo ("<script>alert('修改成功');location='/admin/information/info_list'</script>");
        }else{
            echo ("<script>alert('修改失败,系统错误');location='/admin/information/info_list'</script>");
        }
    }
}
