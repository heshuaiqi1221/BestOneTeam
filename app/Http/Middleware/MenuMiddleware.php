<?php

/*
 * This file is part of the gedongdong/laravel_rbac_permission.
 *
 * (c) gedongdong <gedongdong2010@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Middleware;

use App\Http\Models\Menu;
use App\Http\Models\MenuRoles;
use App\Http\Models\Users;
use App\Http\Models\UsersRoles;
use Closure;
use App\Http\Models\Roles;
use App\Http\Models\Menu as MenuModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->session()->get('user');

        $menu_tree = [];
        $menu_arr = [];
        $menus = MenuModel::all()->toArray();
        foreach ($menus as $m) {
            $menu_arr[$m['id']] = $m;
        }

        if (Users::ADMIN_YES == $user['administrator']) {
            //超管获取所有菜单
            MenuModel::menuTree($menu_arr, $menu_tree);
        } else {
            //$role_ids = UsersRoles::where('users_id', '=', $user['id'])->pluck('roles_id')->toArray();

            // $menu_ids = MenuRoles::whereIn('roles_id', $role_ids)->pluck('menu_id')->toArray();

            // $menus = MenuModel::whereIn('id', $menu_ids)->get()->toArray();
            // //dd($menus);
            // $menu_tmp = [];
            // foreach ($menus as $m) {
            //     $menu_tmp[$m['id']] = $m;
            //     //同时获取父级菜单
            //     if (0 != $m['pid'] && !array_key_exists($m['pid'], $menu_tmp)) {
            //         $menu_tmp[$m['pid']] = $menu_arr[$m['pid']];
            //     }
            // }
            $user = Users::where('id', '=', $user['id'])->get()->toArray();
            //dd($user);
            $menu_ids = MenuRoles::where('roles_id',$user[0]['r_id'])->pluck('menu_id')->toArray();
            //dd($menu_ids);
            if(empty($menu_ids)){
                echo "<script>alert('无权限，请联系超管');location.href='https://www.baidu.com';</script>";exit;
            }
            $menus = MenuModel::whereIn('id', $menu_ids)->get()->toArray();
            //dd($menus);
            foreach ($menus as $m) {
                //dd($m);
                $menu_tmp[$m['id']] = $m;
                //dd($menu_tmp);
                //同时获取父级菜单
                if (0 != $m['pid'] && !array_key_exists($m['pid'], $menu_tmp)) {
                    $menu_tmp[$m['pid']] = $menu_arr[$m['pid']];
                }
            }
            // $roles = Roles::where(['id'=>$user[0]['r_id']])->get()->toArray();
            // $q_id = explode(',',$roles[0]['q_id']);
            // //dd($q_id);
            // // foreach ($q_id as $k => $v) {
            // //     $menu_tmp = MenuModel::where(['route'=>$v])->get()->toArray();
            // // }
            // foreach ($roles as $m) {
            //     //dd($m);
            //     $menu_tmp[$m['id']] = $m;
            //     //dd($menu_tmp);
            //     //同时获取父级菜单
            //     if (0 != $m['pid'] && !array_key_exists($m['pid'], $menu_tmp)) {
            //         dd($menu_tmp);
            //         $menu_tmp[$m['pid']] = $menu_arr[$m['pid']];
            //     }
            // }


            //dd($menu_tmp);

            MenuModel::menuTree($menu_tmp, $menu_tree);
        }

        View::share('menu_tree', $menu_tree);

        //控制菜单选中效果
        $currRouteName = Route::currentRouteName();
        $cache_key = 'menu_route_'.session('user')['id'];
        if (Menu::where('route', $currRouteName)->count() > 0) {
            //当前路由为菜单
            Cache::put($cache_key, $currRouteName, 120);
        } else {
            if (Cache::has($cache_key)) {
                $currRouteName = Cache::get($cache_key);
            }
        }
        View::share('currRouteName', $currRouteName);

        return $next($request);
    }
}
