<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Lect;
use App\Http\Models\Catelog;
class CatelogController extends Controller
{

    public function index(Request $request)
    {
        $course_id = $request->course_id;
        return view('admin.catelog.index',compact('course_id'));
    }

    public function cate_list(Request $request)
    {
        $img = $_SERVER['HTTP_HOST'];
        return view('admin.catelog.list',compact('img'));

    }
    public function catelog_add(Request $request)
    {
        $res=$request->all();
        //var_dump($res);die;
        if($_FILES['cate_page']['error']==0){
            $file = $_FILES['cate_page'];
            $cate_page = $this->file($file);
        }else{
            $cate_page = '';
        }
        //dd($cate_page);
        $catelog_head=$request['catelog_head'];
        $catelog_name=$request['catelog_name'];
        $catelog_describe=$request['catelog_describe'];
        $is_free=$request['is_free'];
        $course_id=$request['course_id'];
        $req=Catelog::insert([
            'catalog_head'=>$catelog_head,
            'catelog_name'=>$catelog_name,
            'catelog_describe'=>$catelog_describe,
            'is_free'=>$is_free,
            'cate_page'=>$cate_page,
            'course_id'=>$course_id,
        ]);
        if ($req) {
            return json_encode(['code'=>0,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'添加失败']);
        }
    }

    public function catalog_list(Request $request)
    {
        $query=$request->all();

        $course_id= $query['course_id'];
        //dd($course_id);
        //var_dump($lect_name);
        $where=[
            'course_id'=>$course_id,
            'is_del'=>1
        ];

        $data = Catelog::where($where)->paginate(3)->toArray();
        //dd($data);
        foreach($data['data'] as $k=>$v){
//            var_dump($data['data']);
            if($v['is_free']== 0){
                $data['data'][$k]['is_free']='付费';
            }else{
                $data['data'][$k]['is_free']='免费';
            }


        }
//        dd($data);
        $data = json_encode($data);
        return $data;
    }

    public function catelog_del(Request $request)
    {
        $res=$request->all();
//            dd($res);
        $catelog_id=$res['id'];
        $course_id=(int)$res['course_id'];
//           dd($course_id);
        $where=[
            'catelog_id'=>$catelog_id
        ];
//        dd($where);
        $a=2;
        $upd=Catelog::where($where)->update([
            'is_del'=>$a
        ]);
        if($upd){
            return redirect('/admin/catelog/list?id='.$course_id);
           // echo  "<script>alert('删除成功');location.href='';</script>";
        }

    }

    public function catelog_upd(Request $request)
    {
        $res=$request->all();
//            dd($res);
        $catelog_id=$res['id'];
//            dd($catelog_id);
        $where=[
            'catelog_id'=>$catelog_id
        ];
        $sel=Catelog::where($where)->first()->toarray();
//        dd($sel);
        return view('admin.catelog.upd_list',['data'=>$sel]);
    }

    public function catelog_upd_do(Request $request)
    {
        $res=$request->all();
//            dd($res);
//        $catelog_id=$res['id'];
//            dd($catelog_id);
        $catelog_id=array_shift($res);
//        dd($res,$new);
        $where=['catelog_id'=>$catelog_id];
        $upda_do=Catelog::where($where)->update($res);
//       dd($upda_do);
        if($upda_do){
            return ['ase'=>1,"msg"=>"成功"];
        }else{
            return ['ase'=>2,"msg"=>"有数据没更改"];
        }
    }

    //文件上传
    function file($file)
    {

        // var_dump($file);die;
        //文件上传是否错误
        if($file['error']!=0){
            echo json_encode(['code'=>201,'msg'=>"文件上传异常"]);die;
        }
        if($file['size']>1024*1024*2){
            echo json_encode(['code'=>202,'msg'=>"文件太大"]);
        }
        $type = ['image/png','image/jpg','image/jpeg','image/gif','video/mp4'];
        if(!in_array($file['type'],$type)){
            echo json_encode(['code'=>203,'msg'=>"文件类型错误"]);
        }
        $name = $file['name'];
        $ext = pathinfo($name,PATHINFO_EXTENSION);
        //var_dump($ext);die;
        $date = date("Y-n-j");
        //dd($date);
        if(!file_exists("img/".$date)){
            mkdir("img/".$date,777);
        }

        $det = "img/".$date."/".md5(time().rand(1000,9999)).'.'.$ext;
        //dd($det);
        $res = move_uploaded_file($file['tmp_name'],$det);
        return $det;
        // dd($res);
    }

}


