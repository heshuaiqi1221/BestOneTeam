<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Lect;
class LectController extends Controller
{
    //列表展示
     public function index_list(Request $request)
    {
       
        $val = $request->input('val');
        $lect_name = $val;
        $where =[];
        if(!empty($val)){
            $where[] =
                ['lect_name','like',"%$val%"];
        }

        $data = Lect::where($where)->paginate(2)->toArray();
        echo json_encode($data);
          
    }


    public function index(Request $request)
    {
      
        return view('admin.lect.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id=request('id');
        return view('admin.lect.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 讲师添加
     */
    public function store(Request $request)
    {
        //echo 111;die;
        $lect_name = $request->input('lect_name');
        $lect_resume = $request->input('lect_resume');
        $lect_style=$request->input('lect_style');
        if (empty($lect_name) || empty($lect_resume) || empty($lect_style)){
            return json_encode(['code'=>2,'msg'=>'参数不能为空']);
        }
        $lect_image = $_FILES['file'];
         //var_dump($lect_image);die;
        $path = "";
        if ($request->hasFile('file')) {
            $path = $request->file->store('/'.date("Y-n-j"));

        }
        //入库
        $data = Lect::insert([
            'lect_name'=>$lect_name,
            'lect_resume'=>$lect_resume,
            'lect_style'=>$lect_style,
            'lect_image'=>$path
        ]);
        if ($data) {
            return json_encode(['code'=>0,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'添加失败']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 调用修改
     */
    public function show($id)
    {
        if (empty($id)) {
            return json_encode(['code'=>1,'msg'=>'参数不能为空!']);
        }
        //查询数据库
        $data = Lect::where(['lect_id'=>$id])->first();
        return json_encode(['code'=>0,'data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 展示修改页面
     */
    public function edit(Request $request)
    {
         $id=request('id');
         $info=Lect::where('lect_id',$id)->first()->toArray();
        //  echo "<pre>";
        // var_dump($info);die;
        return view('admin.lect.update',['info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 处理修改
     */
    public function update(Request $request)
    {
        $id=$request->input('lect_id');
        //var_dump($id);die;
        $lect_name = $request->input('lect_name');
        $lect_resume = $request->input('lect_resume');
        $lect_style=$request->input('lect_style');
        //var_dump($lect_style);die;
        if (empty($lect_name) || empty($lect_resume) || empty($lect_style)){
            return json_encode(['code'=>2,'msg'=>'参数不能为空']);die;
        }
        $lect_image = $_FILES['file'];
        $path = "";
        if ($request->hasFile('file')) {
            $path = $request->file->store('/'.date("Y-n-j"));
            //var_dump($path);die;
        }

        $res=Lect::where('lect_id',$id)->update(['lect_name'=>$lect_name,'lect_resume'=>$lect_resume,'lect_style'=>$lect_style,'lect_image'=>$path]);
        //var_dump($res);die;
        if ($res) {
            return json_encode(['code'=>0,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>1,'msg'=>'修改失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 删除
     */
    public function destroy(Request $request)
    {
         $id=request('id');
        $res = Lect::where('lect_id',$id)->delete();
        if($res){
            return json_encode(['code'=>0,'msg'=>'删除成功!']);
        }else{
            return json_encode(['code'=>1,'msg'=>'删除失败!']);
        }
    }
}
