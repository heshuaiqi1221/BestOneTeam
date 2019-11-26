@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>修改</title>
</head>
<body>
<h1>修改页面</h1>
<br/>

<div class="layui-form-item">
    <label class="layui-form-label">讲师姓名</label>
    <div class="layui-input-inline">
        <input type="text" name="lect_name" value="{{$info['lect_name']}}" autocomplete="off" placeholder="请输入名称" class="layui-input">
    </div>
</div>

<input type="hidden" name="lect_id" value="{{$info['lect_id']}}">

<div class="layui-form-item">
    <label class="layui-form-label">个人简介</label>
    <div class="layui-input-inline">
        <input type="text" name="lect_resume" value="{{$info['lect_resume']}}"  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">讲师头像</label>
    <div class="layui-input-inline">
        <input type="file" name="image" id="file">
        <!-- <img src="{{asset($info['lect_image'])}}"> -->
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">授课风格</label>
    <div class="layui-input-inline">
        <input type="text" value="{{$info['lect_style']}}" name="lect_style" lay-verify="required" placeholder="讲师授课风格" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <button type="" class="btt layui-btn layui-btn-normal">修改</button>
</div>
</body>
</html>
<script type="text/javascript">
    {{--var id = getUrlParam('id');--}}
    {{--//console.log(id);--}}
    {{--$.ajax({--}}
    {{--    url:"{{url('admin/lect/edit')}}",--}}
    {{--    type:"GET",--}}
    {{--    dataType:"json",--}}
    {{--    success:function(res){--}}
    {{--        $("[name='lect_name']").val(res.data.lect_name);--}}
    {{--        $("[name='lect_resume']").val(res.data.lect_resume);--}}
    {{--        $("[name='lect_style']").val(res.data.lect_style);--}}
    {{--    }--}}
    {{--})--}}

    {{--function getUrlParam(name) {--}}
    {{--    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象--}}
    {{--    var r = window.location.search.substr(1).match(reg);  //匹配目标参数--}}
    {{--    if (r != null) return decodeURI(r[2]); return null; //返回参数值--}}
    {{--}--}}

    //修改
    $(document).on('click','.btt',function(){
         //alert(1111);
        var lect_name = $("[name='lect_name']").val();
        var lect_resume = $("[name='lect_resume']").val();
        var lect_style = $("[name='lect_style']").val();
        var lect_id=$("[name='lect_id']").val();
        //console.log(lect_id);
        var formData = new FormData();
        var file = $('#file')[0].files[0];
        //console.log(file);return;
        formData.append('file',file);
        formData.append('lect_name',lect_name);
        formData.append('lect_resume',lect_resume);
        formData.append('lect_style',lect_style);
        formData.append('lect_id',lect_id);
        //调用后台接口

        $.ajax({
            url:"{{url('admin/lect/update')}}",
            data:formData,
            type:"POST",
            dataType:"json",
            processData : false, // 使数据不做处理
            contentType : false, // 不要设置Content-Type请求头
            success:function(res){
                //alert(res.msg);
                if (res.code==2){
                    location.href="{{url('admin/lect/list')}}";
                }else{
                    alert(res.msg);
                    location.href="{{url('admin/lect/list')}}";
                }

            }

        })
    });

</script>

@endsection
