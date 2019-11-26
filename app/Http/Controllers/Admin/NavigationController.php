<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
{
    //后台导航添加视图
    public function navigationAdd()
    {
        return view('admin.navigation.navigationadd');
    }

    //后台导航添加执行
    public function navigationData(Request $request)
    {
        $data = $request->all();
        $data['n_time'] = time();
        $res = Navigation::insert($data);
        if($res){
            echo "<script>alert('添加成功');location.href='/admin/navigation/list';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/admin/navigation/add';</script>";
        }
    }

    //后台导航列表
    public function navigationList()
    {
        $pageSize = config('app.pageSize');
        $data = Navigation::where('is_show',1)->paginate($pageSize);
        return view('admin.navigation.navigationlist',compact('data'));
    }

    //后台导航修改视图
    public function navigationExit(Request $request)
    {
        $n_id = $request->n_id;
        $data = Navigation::where('n_id',$n_id)->get()->toArray()[0];
        return view('admin.navigation.navigationexit',compact('data'));
    }

    //后台导航修改执行
    public function navigationExitdo(Request $request)
    {
        $n_id = $request->n_id;
        $data = $request->all();
        $res = Navigation::where('n_id',$n_id)->update($data);
        if($res){
            echo "<script>alert('修改成功');location.href='/admin/navigation/list';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/admin/navigation/list';</script>";
        }
    }

    //后台导航删除
    public function navigationDel(Request $request)
    {
        $n_id = $request->n_id;
        $res = Navigation::where('n_id',$n_id)->update(['is_show'=>2]);
        if($res){
            echo "<script>alert('删除成功');location.href='/admin/navigation/list';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='/admin/navigation/list';</script>";
        }
    }
}
