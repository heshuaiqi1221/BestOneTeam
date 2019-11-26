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
<h1>文章添加</h1>
<br/>
<form action="" id="form">
<div class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline">
            <input type="text" name="catelog_head" autocomplete="off" placeholder="请输入标题" class="layui-input">
            <input type="hidden" name="course_id" value="{{$course_id}}"/>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">章节名称</label>
        <div class="layui-input-inline">
            <input type="text" name="catelog_name" autocomplete="off" placeholder="请输入名称" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-lnline">
            <input type="text" name="catelog_describe" lay-verify="required" placeholder="请写入描述" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否免费</label>
        <div class="layui-input-block">
            <input type="radio" name="is_free" value="0" title="否" checked>
            <input type="radio" name="is_free" value="1" title="是">
        </div>
    </div>
    <div class="layui-form-item">
    <div class="layui-form-item">
        <label class="layui-form-label">文章视频</label>
        <div class="layui-input-inline">
            <input type="file" name="cate_page" id="file">
        </div>
    </div>
    </div>
    <div class="layui-form-item">
        <button type="button" class="abb layui-btn layui-btn-normal">添加</button>
    </div>
</div>
</form>
</html>
<script>
layui.use(['form', 'layedit', 'laydate'], function(){
});
</script>
<script>

    $(document).on('click','.abb',function(){
        ///alert(111);
        // var catelog_head = $("[name='catelog_head']").val();
        // var catelog_name = $("[name='catelog_name']").val();
        var course_id = $("[name='course_id']").val();
        // var is_free = $("[name='is_free']").val();
        var fd = new FormData($("#form")[0]);
        //调用后台接口
        $.ajax({
            url:"{{url("admin/catelog/catelog_add")}}",
            data:fd,
            type:"POST",
            dataType:"json",
            contentType:false,
            processData:false,
            success:function(res){
                alert(res.msg);
                location.href="list?id="+course_id;
            }

        })
    });
</script>


@endsection



