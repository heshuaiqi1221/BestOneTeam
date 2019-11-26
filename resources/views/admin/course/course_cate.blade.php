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
            <input type="text" name="cate_name" autocomplete="off" placeholder="请输入姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
          <label class="layui-form-label">是否选择分类</label>
          <div class="layui-input-inline">
            <select name="pid" id="option">
              <option value="">请选择分类</option>
            @foreach($infinitus as $v)
                <option value="{{$v['cate_id']}}"><?php echo str_repeat("|—",$v['leavel']+1);?>{{$v['cate_name']}}</option>
            @endforeach
            </select>
          </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类备注</label>
        <div class="layui-input-lnline">
            <input type="text" name="cate_describe" lay-verify="required" placeholder="请描述分类" autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <button type="button" class="abb layui-btn layui-btn-normal">添加</button>
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
        var pid=$('select[name=pid]').val();
        var cate_id = $('#option').val();
        var cate_describe=$('input[name=cate_describe]').val();
        //console.log(cate_id);return;
        $.ajax({
            type:'POST',
            url:'/admin/course_cate_do',
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



