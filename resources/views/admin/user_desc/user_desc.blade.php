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
<form action="" id="form">
    <div class="layui-form layui-form-pane" >
        <div class="layui-form-item">
            <label class="layui-form-label">用户名称</label>
            <div class="layui-input-inline">
                <input type="text" name="u_name" autocomplete="off" placeholder="请输入姓名" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-item">
                <label class="layui-form-label">头像</label>
                <div class="layui-input-inline">
                    <input type="file" name="u_head" id="file">
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-form-item">
                <label class="layui-form-label">生日</label>
                <input type="date" name="u_age" value="">
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="u_sex" value="男" title="男" checked="">
                    <input type="radio" name="u_sex" value="女" title="女">
                </div>
            </div>

            <div class="layui-form-item">
                <button type="button" class="abb layui-btn layui-btn-normal">添加</button>
            </div>

        </div>


    </div>
</form>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
    });
</script>
<script>
    //alert(1);
    $(document).on('click','.abb',function(){

        // var course_name=$('input[name=course_name]').val();
        // var cate_id=$('select[name=cate_id]').val();
        // var is_free = $("input[name='is_free']:checked").val();
        // var status = $("input[name='status']:checked").val();
        // var close=$("input[name='close']:checked").val();
        // //var course_page=$('input[name=course_page]').val();
        // var price=$('input[name=price]').val();
        //var introduce = $('#add').val();
        //模拟表单对象
        var fd = new FormData($("#form")[0]);
        //获取到文件
        $.ajax({
            type:'POST',
            url:'/admin/user_desc_add',
            data:fd,//
            dataType:'json',
            contentType:false,
            processData:false,
            success:function(res){
                if(res.code=1){
                    alert(res.msg);
                    location.href="/admin/user_desc_list";
                }else{
                    alert(res.msg);
                    location.href='/admin/user_desc';
                }
            }
        });
    });
</script>

@endsection



