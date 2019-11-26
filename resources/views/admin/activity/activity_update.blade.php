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
<h1>编辑详情</h1>
<br/>
<form action="">
    <input type="hidden" name="act_id" value="{{$res[0]['act_id']}}" id="act_id">
    <div class="layui-form layui-form-pane" >
        <div class="layui-form-item">
            <label class="layui-form-label">活动标题</label>
            <div class="layui-input-block">
                <input type="text" name="act_title" id="act_title" lay-verify="title" autocomplete="off" placeholder="请输入活动标题" class="layui-input" value="{{$res[0]['act_title']}}">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">课程分类</label>
            <div class="layui-input-inline">
                <select name="course_id">
                    <option value="">请选择分类</option>
                    @foreach($data1 as $v)
                        <option value="{{$v['course_id']}}">{{$v['course_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">活动内容</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="act_content" class="layui-textarea" id="act_content">{{$res[0]['act_content']}}</textarea>
            </div>
        </div>


        <div class="layui-form-item">
            <button type="button" class="layui-btn layui-btn-normal" id="btn">修改</button>
        </div>

    </div>



</form>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
    });
</script>
<script>
    $(document).on('click','#btn',function(){
        var act_id = $('#act_id').val();
        var act_title = $('#act_title').val();
        var act_content = $('#act_content').val();
        var reg=/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
        if(act_title==''){
            alert('活动标题不得为空');
            return false;
        }
        if(!reg.test(act_title)){
            alert("标题必须是中文字幕数字下划线");
            return false;
        }
        $.ajax({
            url:"/admin/activity_update_do",
            data:{act_id:act_id,act_title:act_title,act_content:act_content},
            Type:"GET",
            dataType:"json",
            success:function(res){
                if(res.code==200){
                    alert(res.message);
                    location.href="/admin/activity_list";
                }else{
                    alert(res.message);
                    location.href="/admin/activity_list";
                }
            }
        });
    });
</script>

@endsection