<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\MenuRoles;
use App\Http\Models\Menu;
use App\Http\Models\Users;
use App\Http\Models\Permission;
use App\Http\Models\RolePermission;
use App\Http\Models\Roles;
use App\Library\Response;
use App\Validate\RolesStoreValidate;
use App\Validate\RolesUpdateValidate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

 class RolesController extends Controller
 {
    public function roles_add()
    {
        //$where = ['pid' , '>' , '0' ];
        $menu = Menu::where('pid','!=',0)->get()->toArray();
        //dd($menu);
        return view('admin.roles.roles_add',compact('menu'));
    }

    public function roles_add_do()
    {
        $post = Request()->all();
        //dd($post);
        //$q_id = implode($post['q_id'],',');
        //dd($q_id);

        $data = [
            'name' => $post['name'],
            'created_time'=>time(),
            'updated_time'=>time()
        ];
        //dd($data);
        $data = Roles::insert($data);
        if($data){
            $roles = Roles::orderBy('id','desc')->get()->toArray();
            //dd($roles);
            foreach ($post['q_id'] as $key => $value) {
                $menu = MenuRoles::insert(['menu_id'=>$value,'roles_id'=>$roles[0]['id'],'created_time'=>time()]);
            }
            if($menu){
                return redirect('/admin/roles/roles_index');
            }

        }
        //dd($data);

    }

    public function roles_index()
    {
        //dd(1);
        $roles = Roles::paginate(3);

        // foreach ($roles as $key => $value) {
        //     //dd($value[]);
        //     $q_id[] = explode(',',$value['q_id']);
        // }
        // dd($q_id);
        // foreach ($q_id as $k => $v) {
        //         //dd($k);
        //         foreach ($v as $key => $value) {
        //             //dd($value);
        //             $menu[] = Menu::where(['id'=>$value])->get()->toArray();
        //         }

        //     }
        // dd($menu);
        return view('admin.roles.index',compact('roles'));
    }

    public function is_del()
    {
        $post = request()->all();
        //dd($post);
        $users = Users::where(['r_id'=>$post['id']])->get()->toArray();
        //dd($users);
        if(!empty($users)){
            //dd(1);
            return json_encode(['code'=>3,'msg'=>'请先去清空分类!']);
        }
        //dd($users);
        if (empty($post['id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data = Roles::where(['id'=>$post['id']])->update(['is_del'=>$post['is_del']]);
            return json_encode(['code'=>2,'msg'=>'修改成功']);
        }
    }

    public function roles_edit()
    {
        $post = request()->all();
        $roles = Roles::where(['id'=>$post['id']])->get()->toArray();

        $menu = Menu::where('pid','!=',0)->get()->toArray();
        //dd($menu);
        return view('admin.roles.roles_edit',compact('roles','menu'));
    }

    public function roles_edit_do()
    {

        $post = Request()->all();
        $data = [
            'name' => $post['name'],
            'updated_time'=>time()
        ];
        //dd($data);
        $data = Roles::where(['id'=>$post['id']])->update($data);
        if($data){
            $roles = Roles::orderBy('id','desc')->get()->toArray();
            //dd($roles);
            MenuRoles::where(['roles_id'=>$post['id']])->delete();
            foreach ($post['q_id'] as $key => $value) {
                $menu = MenuRoles::insert(['menu_id'=>$value,'roles_id'=>$post['id'],'created_time'=>time()]);
            }
            if($menu){
                return redirect('/admin/roles/roles_index');
            }

        }
    }
 }

