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
<h1>文章修改</h1>
<br/>
<div class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <label class="layui-form-label">文章标题</label>
        <div class="layui-input-inline">
            <input type="text" name="catalog_head" autocomplete="off" value="{{$data['catalog_head']}}" class="layui-input">
            <input type="hidden" name="course_id" value="{{$data['course_id']}}"/>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">章节名称</label>
        <div class="layui-input-inline">
            <input type="text" name="catelog_name" autocomplete="off" value="{{$data['catelog_name']}}" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-lnline">
            <input type="text" name="catelog_describe" lay-verify="required" value="{{$data['catelog_describe']}}" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否免费</label>
        <div class="layui-input-block">
            @if($data['is_free'] == 0)
            <input type="radio" name="is_free" value="0" title="否" checked>
            <input type="radio" name="is_free" value="1" title="是">
            @else
                <input type="radio" name="is_free" value="0" title="否" >
                <input type="radio" name="is_free" value="1" title="是" checked>
            @endif

        </div>
    </div>
    <div class="layui-form-item">
        <button type="submit" class="abb layui-btn layui-btn-normal">修改</button>
    </div>
</div>
</html>

<script type="text/javascript">

    $(document).on('click','.abb',function(){
        //alert(111);
        var catelog_id = getUrlParam('id');
        var catalog_head = $("[name='catalog_head']").val();
        var course_id = $("[name='course_id']").val();
        var catelog_name = $("[name='catelog_name']").val();
        var catelog_describe = $("[name='catelog_describe']").val();
        var is_free = $("[name='is_free']").val();
        //调用后台接口
        $.ajax({
            url:"{{url("/admin/catelog/catelog_upd_do")}}",
            data:{catelog_id:catelog_id,catalog_head:catalog_head,catelog_name:catelog_name,catelog_describe:catelog_describe,is_free:is_free},
            type:"POST",
            dataType:"json",
            success:function(res){
                alert(res.msg);
                location.href="/admin/catelog/list?id="+course_id;
            }
        })
    });
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
    }
</script>

@endsection