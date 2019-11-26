@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加</title>
</head>
<body>
<h1>课程分类</h1>
<br/>
<div class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-inline">
            <input type="text" name="cate_name" value="{{$data[0]['cate_name']}}" autocomplete="off" placeholder="请输入姓名" class="layui-input">
            <input type="hidden" value="{{$data[0]['cate_id']}}" name="cate_id"/>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类备注</label>
        <div class="layui-input-lnline">
            <input type="text" name="cate_describe" value="{{$data[0]['cate_describe']}}" lay-verify="required" placeholder="请描述分类" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <button type="button" class="abb layui-btn layui-btn-normal">修改</button>
    </div>
</div>
</html>
<script>
layui.use(['form', 'layedit', 'laydate'], function(){
});
</script>
<script>
//alert(1);
    $('.abb').click(function(){
        //alert(123);
        var cate_name=$('input[name=cate_name]').val();
        var cate_id=$('input[name=cate_id]').val();
        var cate_describe=$('input[name=cate_describe]').val();
        //console.log(cate_id);return;
        $.ajax({
            type:'POST',
            url:'/admin/course_cate_update_do',
            data:{cate_name:cate_name,cate_describe:cate_describe,cate_id:cate_id},
            dataType:'json',
            success:function(res){
                if(res.code=1){
                    alert(res.msg);
                    location.href="/admin/course_cate_list";
                }else{
                    alert(res.msg);
                }
            }
        });
    });
</script>

@endsection



