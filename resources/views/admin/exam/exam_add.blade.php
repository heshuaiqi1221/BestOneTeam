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
<h1>考试管理</h1>
<br/>
<form action="">
    <div class="layui-form layui-form-pane" >
        <div class="layui-form-item">
            <label class="layui-form-label">考试指导标题</label>
            <div class="layui-input-block">
                <input type="text" name="exam_title" id="exam_title" lay-verify="title" autocomplete="off" placeholder="请输入考试指导标题" class="layui-input">
                <input type="hidden" name="course_id" value="{{$course_id}}" id="course_id"/>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">考试指导内容</label>
            <div class="layui-input-block">
                <textarea placeholder="请输入内容" name="exam_content" class="layui-textarea" id="exam_content"></textarea>
            </div>
        </div>


        <div class="layui-form-item">
            <button type="button" class="layui-btn layui-btn-normal" id="btn">添加</button>
        </div>

    </div>


</form>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
    });
</script>
<script>
    $(document).on('click','#btn',function () {
        var exam_title = $('#exam_title').val();
        var exam_content = $('#exam_content').val();
        var course_id = $('#course_id').val();
        var reg =/^[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
        if(exam_title==''){
            alert('考试指导标题不得为空');
            return false;
        }else if(!reg.test(exam_title)){
            alert("标题必须是中文字幕数字下划线");
            return false;
        }
        $.ajax({
            url:"exam_add_do",
            data:{course_id:course_id,exam_title:exam_title,exam_content:exam_content},
            Type:"POST",
            dataType:"json",
            success:function(res){
                if(res.code==200){
                    alert(res.message);
                    location.href="/admin/exam_list?id="+course_id;
                }else{
                    alert(res.message);
                }
            }
        });
    });
</script>
@endsection