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
<h1>会员添加</h1>
<br/>
<form action="" id="form">
<div class="layui-form layui-form-pane" >

    <div class="layui-form-item">
        <label class="layui-form-label">会员名称</label>
        <div class="layui-input-inline">
            <input type="text" name="uname" autocomplete="off" placeholder="请输入名称" class="layui-input">
            <input type="hidden" name="u_id" value="{{$u_id}}"/>
            <input type="hidden" name="id" value="{{$id}}"/>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">会员年龄</label>
        <div class="layui-input-inline">
            <input type="text" name="uage" autocomplete="off" placeholder="请输入年龄" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">性别</label>
        <div class="layui-input-block">
            <input type="radio" name="usex" value="1" title="男">
            <input type="radio" name="usex" value="2" title="女">
        </div>
    </div>

    <div class="layui-form-item">
    <label class="layui-form-label">是否是会员</label>
    <div class="layui-input-block">
    <input type="radio" name="utype" value="1" title="是">
      <input type="radio" name="utype" value="2" title="否">
    </div>
  </div>

    {{--<div class="layui-form-item">--}}
    {{--<div class="layui-form-item">--}}
        {{--<label class="layui-form-label">会员图片</label>--}}
        {{--<div class="layui-input-inline">--}}
            {{--<input type="file" name="uimg" id="file">--}}
        {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}

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
//alert(1);
    $(document).on('click','.abb',function(){

        // var course_name=$('input[name=course_name]').val();
        var u_id=$('input[name=u_id]').val();
        var id=$('input[name=id]').val();
        //console.log(u_id);
        //console.log(id);return;
        // var is_free = $("input[name='is_free']:checked").val();
        //var status = $("input[name='hidden']:checked").val();
        // var close=$("input[name='close']:checked").val();
        // //var course_page=$('input[name=course_page]').val();
        // var price=$('input[name=price]').val();
        //var introduce = $('#add').val();
        //模拟表单对象
        var fd = new FormData($("#form")[0]);
        // console.log(fd);
        // return false;
        //获取到文件
        $.ajax({
            type:'POST',
            url:'/admin/vipadd_do',
            data:fd,//
            dataType:'json',
            contentType:false,
            processData:false,
            success:function(res){
                console.log(res);
                if(res.code=1){
                    alert(res.msg);
                    if(u_id==''){
                        //alert(1);
                        location.href="/admin/viplist?id="+id;
                    }else{
                        location.href="/admin/viplist?u_id="+u_id;
                    }

                }else{
                    alert(res.msg);
                    if(u_id==''){
                        //alert(1);
                        location.href="/admin/vipadd?id="+id;
                    }else{
                        location.href="/admin/vipadd?u_id="+u_id;
                    }
                }
            }
        });
    });
</script>

@endsection



