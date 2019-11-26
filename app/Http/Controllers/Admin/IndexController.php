<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class IndexController extends Controller
{
    /**
     * 后台登录
     */
    public function login()
    {
        return view('admin.login');
    }
    public function login_do(Request $request)
    {
         $data = request() -> all();
        // dd($data);
        $data['pwd'] = md5($data['pwd']);
        // dd($data['pwd']);
        $a = DB::table('admin')->where('admin_name','=',$data['admin_name'])->first();
        //dd($a);
        if(empty($a)){
            return 2 ;
        }else {
            if($a->admin_name==$data['admin_name']&&$a->pwd==$data['pwd']){
            return 1 ;
                 $request->session()->put('admin_name', $data['admin_name']);
            }else{
            return 3 ;

            }
        }
    }

    /**
     * 后台首页
     */
    public function index()
    {
        return view('admin.index');
    }

    // 管理员添加
    public function  add()
    {
       return view('admin.add');
    }
    // 添加执行
    public function add_do(Request $request)
    {
        $data = $request -> all();
        // dd($data['pwd'],$data['pwd1']);
        if($data['pwd'] != $data['pwd1']){
            echo "<script>history.go(-1),alert('两次密码输入的不一致')</script>";die;
        }
        $data['pwd'] == $data['pwd1'];
        $data['pwd'] = md5($data['pwd']);
        // $list = $dataa

        // dd($data);
        $res = DB::table('admin')->insert([
            'admin_name' => $data['admin_name'],
            'pwd' => $data['pwd']
        ]);
        // dd($res);
        if($res){
                echo "<script>window.location.href='/admin/index',alert('添加成功');</script>";
            }else{
                echo "<script>history.go(-1),alert('添加失败');</script>";
            }
    }
    // 用户列表
    public function  list()
    {
       return view('admin.list');
    }

    public function role()
    {
        return view('admin.role');
    }
}
