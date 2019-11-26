<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Slide;


class SlideshowController extends Controller
{
    //轮播图添加视图
    public function slideshowAdd()
    {
        return view('admin.slideshow.slideshowadd');
    }

    //轮播图添加执行
    public function slideshowData(Request $request)
    {
        $s_img = $request->s_img;
        $s_name = $request->s_name;
        $s_weight = $request->s_weight;
        if($request->hasFile('s_img')){
            $s_img= $this->upload($request,'s_img');
        }
        $time=time();
        $data= [
            's_img'=>$s_img,
            's_name'=>$s_name,
            'created_at'=>$time,
            's_weight'=>$s_weight
        ];
        $validatedData = $request->validate([
            's_name' => 'required',
            's_weight' => 'required',

        ],[
            's_name.required' =>'轮播图名称不能为空',
            's_name.required' =>'轮播图权重不能为空',
        ]);
        $res = Slide::insert($data);
        if ($res) {
            echo "<script>alert('添加成功');location.href='/admin/slideshow/list'</script>";
        } else {
            echo "<script>alert('添加失败');location.href='/admin/slideshow/add'</script>";
        }

    }

    //轮播图列表
    public function slideshowList()
    {
        //$query=request()->all();

        // $where=[];
        $data= Slide::where(['is_show'=>1])->paginate(2);
        //dd($data);
        return view('admin.slideshow.slideshowlist',['data'=>$data]);

    }

    //轮播图修改视图
    public function slideshowExit()
    {
        $s_id = request()->s_id;
        if($s_id==''){
            echo "<script>alert('添加失败');location.href='/admin/slideshow/list'</script>";die;
        }
        $data = Slide::where(['s_id'=>$s_id])->get()->toArray();
        return view('admin.slideshow.slideshowexit',compact('data'));
    }

    //轮播图修改执行
    public function slideshowExitdo(Request $request)
    {
                $s_img = $request->s_img;
        $s_name = $request->s_name;
        $s_weight = $request->s_weight;
        $s_id = $request->s_id;

        //dd($s_id);
        if($request->hasFile('s_img')){
            $s_img= $this->upload($request,'s_img');
        }
        $time=time();
        $data= [
            's_img'=>$s_img,
            's_name'=>$s_name,
            'created_at'=>$time,
            's_weight'=>$s_weight
        ];
        $validatedData = $request->validate([
            's_name' => 'required',
            's_weight' => 'required',

        ],[
            's_name.required' =>'轮播图名称不能为空',
            's_name.required' =>'轮播图权重不能为空',
        ]);
        $res = Slide::where(['s_id'=>$s_id])->update($data);
        if ($res) {
            echo "<script>alert('修改成功');location.href='/admin/slideshow/list'</script>";
        } else {
            echo "<script>alert('修改失败');location.href='/admin/slideshow/exit'</script>";
        }
    }

    //轮播图删除
    public function slideshowDel()
    {
        $s_id=request()->all();
        $res=Slide::where('s_id',$s_id)->update(['is_show'=>2]);
        if ($res) {
            return "<script>alert('删除成功');location.href='/admin/slideshow/list'</script>";
        } else {
            return "<script>alert('删除失败');location.href='/admin/slideshow/list'</script>";
        }
    }

    //上传
    public function upload(Request $request,$s_desc)
    {
        if ($request->file($s_desc)->isValid()) {
            $post=$request->file($s_desc);
            $extension=$request->$s_desc->extension();
            $store_result=$post->storeAs(date('YMD'),date('YHis').rand(100,999).'.'.$extension);
            return $store_result;
        }
        exit('上传文件出错');
    }
}
