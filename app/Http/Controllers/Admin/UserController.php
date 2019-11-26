<?php

/*
 * This file is part of the gedongdong/laravel_rbac_permission.
 *
 * (c) gedongdong <gedongdong2010@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Roles;
use App\Http\Models\Users;
use App\Http\Models\UsersRoles;
use App\Library\Response;
use App\Validate\UserStoreValidate;
use App\Validate\UserUpdateValidate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_create()
    {
        $roles = Roles::get()->toArray();
        //dd($roles);
        return view('admin.user.create',compact('roles'));
    }

    public function user_create_do()
    {
        $post = request()->all();
        //dd($post);
        if($post['password_repeat'] != $post['password'])
        {
            return redirect('/admin/user/user_create');exit;
        }
        $create_time = time();
        $data = [
            'email' => $post['email'],
            'users_name' => $post['users_name'],
            'password' => md5($post['password']),
            'status' => $post['status'],
            'created_time' =>  $create_time,
            'r_id' => $post['r_id'],
            'updated_time' => $create_time
        ];
        $data = Users::create($data);
        if ($data) {
                return redirect('/admin/user/user_index');
        }
    }

    public function user_index()
    {
        $users = Roles::join("Users","Roles.id","=","Users.r_id")->where(['administrator'=>0])->paginate(3);
        //dd($users);
        return view('admin.user.user_index',compact('users'));
    }

    //点击状态
    public function status()
    {
       $post = request()->all();
        //dd($post);
        if (empty($post['id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data = Users::where(['id'=>$post['id']])->update(['status'=>$post['status']]);
            return json_encode(['code'=>2,'msg'=>'修改成功']);
        }
    }

    public function edit()
    {
        $post = request()->all();
        //dd($post);
        $data = Users::where(['id'=>$post['id']])->get()->toArray();
        $roles = Roles::get()->toArray();
        //dd($roles);
        return view('admin.user.edit',compact('data','roles'));
    }

    public function edit_do()
    {
        $post = request()->all();
       // dd($post);
        $updated_time = time();
        $data = [
            'email' => $post['email'],
            'users_name' => $post['users_name'],
            'status' => $post['status'],
            'updated_time' => $updated_time
        ];
        $data = Users::where(['id'=>$post['id']])->update($data);
        if ($data) {
                return redirect('/admin/user/user_index');
        }
    }
}
