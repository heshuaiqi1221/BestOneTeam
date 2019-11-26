<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Models\Lect;
use App\Http\Models\Iuser;
use App\Http\Models\User;
class VipController extends Controller
{

    /**
     * 会员添加页面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function vipadd(Request $request)
    {
        $query = request()->all();
        $u_id=$query['u_id']??'';
        $id=$query['id']??'';
        return view('admin.vip.vipadd',compact('u_id','id'));
    }

    /**
     * 会员添加执行
     * @param Request $request
     * @return false|mixed|string
     */
    public function vipadd_do(Request $request)
    {
        $data = $request->post();
        //dd($data);
        $res=Iuser::insert([
            'uname'=>$data['uname'],
            'usex'=>$data['usex'],
            'uage'=>$data['uage'],
            'utime'=>time(),
            'utype'=>$data['utype'],
            'ago_id'=>$data['u_id'],
            'queen_id'=>$data['id']
        ]);
        if ($res){
            return json_encode(['code'=>0,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'添加失败']);
        }
    }
//    public function viplist(Request $request)
//    {
//
//        $query = request()->all();
//
//        //dd($query);
//        $uname=$query['uname']??'';
//        $u_id=$query['u_id']??'';
//        $id=$query['id']??'';
//        //dd($u_id);
//        //dd($id);
//        if($u_id=='' && $id==''){
//            return redirect('/admin/index');exit;
//        }
//        //dd($u_id);
//        $where =[];
//        if ($uname) {
//            $where[]=['uname','like',"%$uname%"];
//        }
//        $pageSize=config('app.pageSize');
//        if($u_id == ''){
//            //dd(1);
//            $data = Iuser::join("Users","i_user.queen_id","=","Users.id")->where(['i_user.type'=>1,'Users.id'=>$id])->whereOr($where)->paginate($pageSize);
//            //dd($data);
//        }else{
//            //dd($u_id);
//            $data = Iuser::join("User","i_user.ago_id","=","User.u_id")->where(['i_user.type'=>1,'User.u_id'=>$u_id])->whereOr($where)->paginate($pageSize);
//        }
//
//        //dd($data);
//        return view('admin.vip.viplist',compact('data','query','uname'));
//
//    }

    public function vipdel(Request $request)
    {
        $uid = $request->get('uid');
        $query = $request->all();
        $u_id=$query['u_id']??'';
        $id=$query['id']??'';
        //修改状态
        $res = Iuser::where(['uid'=>$uid])->update(['type'=>2]);
        if($res){
            if($u_id!=''){
                header("Refresh:2,url=/admin/viplist?u_id=".$u_id);
                die("删除成功,2秒后自动跳到展示页面");
            }else{
                header("Refresh:2,url=/admin/viplist?id=".$id);
                die("删除成功,2秒后自动跳到展示页面");
            }
        }else{
            if($u_id!=''){
                header("Refresh:2,url=/admin/viplist?u_id=".$u_id);
                die("删除失败,请重新删除");
            }else{
                header("Refresh:2,url=/admin/viplist?id=".$id);
                die("删除失败,请重新删除");
            }
        }
    }
    public function vipupd(Request $request)
    {
        $uid = $request->get('uid');
        $query = $request->all();
        $u_id=$query['u_id']??'';
        $id=$query['id']??'';
        //dd($query);
        //修改状态
        $data = Iuser::where(['uid'=>$uid])->select(['utype'])->first();
        $utype = json_decode($data)->utype;
        if ($utype == 1){
            $res = Iuser::where(['uid'=>$uid])->update(['utype'=>2]);
        }else if ($utype == 2){
            $res = Iuser::where(['uid'=>$uid])->update(['utype'=>1]);
        }
        if($res){
            if($u_id!=''){
                header("Refresh:2,url=/admin/viplist?u_id=".$u_id);
                die("设置成功,2秒后自动跳到展示页面");
            }else{
                header("Refresh:2,url=/admin/viplist?id=".$id);
                die("设置成功,2秒后自动跳到展示页面");
            }
        }else{
            if($u_id!=''){
                header("Refresh:2,url=/admin/viplist?u_id=".$u_id);
                die("设置失败,2秒后自动跳到展示页面");
            }else{
                header("Refresh:2,url=/admin/viplist?id=".$id);
                die("设置失败,2秒后自动跳到展示页面");
            }
        }
    }
    //用户会员列表
    public function user_list_vip(Request $request){
        $data =User::join('user_info','user_info.u_id','=','user.u_id')->where(['upgrade'=>2])->paginate(3);
        return view ('admin.vip.user_list_vip',compact(['data']));
    }

    //取消用户会员
    public function quit_user_vip(Request $request){
        $u_id = $request->u_id;
        $res = User::where(['u_id'=>$u_id])->update(['upgrade'=>1]);
        if($res){
            return redirect("/admin/user_list_vip");
        }else{
            return redirect("/admin/user_list_vip");
        }
    }
}

