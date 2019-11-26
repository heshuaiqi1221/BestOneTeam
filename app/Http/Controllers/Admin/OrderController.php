<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Detail;
use App\Http\Models\Order;
use App\Http\Models\Course;
use App\Http\Models\Lect;
use App\Http\Models\User;
use App\Http\Models\Activity;
class OrderController extends Controller
{
    //总订单
    public function blanket_order()
    {
        $data1 = Order::join('Course','Course.course_id','=','Order.course_id')->join('User','User.u_id','=','Order.u_id')->join('Lect','Lect.lect_id','=','Order.lect_id')->where(['Order.is_del'=>1,'User.is_status'=>1,'Lect.is_del'=>1,'Course.close'=>2])->paginate(3);
//        dd($data1);
        return view('admin.order.blanket_order',compact('data1'));
    }


    //讲师订单
    public function lect_order()
    {

        $query = request()->all();
        $res = Order::where(['lect_id'=>$query['lect_id']])->get()->toArray();
        $move=[];
        foreach($res as $k=>$v){
            $move[] +=$v['pay_price'];
    }
        $merge = array_sum($move);
//        $date = Detail::join("Course","Detail.course_id","=","Course.course_id")->join('Order','Order.course_id','=','Detail.course_id')->join('')->where(['Detail.is_del'=>1,'Detail.lect_id'=>$query['lect_id'],'Detail.course_id'=>$query['course_id']])->paginate(2);
        //$date = $date['data'];
        $date = Order::join('Course','Course.course_id','=','Order.course_id')->join('User','User.u_id','=','Order.u_id')->join('Lect','Lect.lect_id','=','Order.lect_id')->where(['Order.is_del'=>1,'User.is_status'=>1,'Order.lect_id'=>$query['lect_id'],'Order.course_id'=>$query['course_id'],'Lect.is_del'=>1,'Course.close'=>2])->paginate(3);
        //$a = 10 / 3;
//        dd($date);
        $lect = Lect::where(['lect_id'=>$query['lect_id']])->get()->toArray();
        //dd($lect);

        $lect_name = $lect[0]['lect_name'];
        //dd($date);
        return view('admin.order.lect_order',compact('date','lect_name','query','merge'));
    }



}
