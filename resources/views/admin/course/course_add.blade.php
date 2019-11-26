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
<h1>课程添加</h1>
<br/>
<form action="" id="form">
<div class="layui-form layui-form-pane" >
    <div class="layui-form-item">
        <label class="layui-form-label">课程名称</label>
        <div class="layui-input-inline">
            <input type="text" name="course_name" autocomplete="off" placeholder="请输入姓名" class="layui-input">
            <input type="hidden" name="lect_id" value="{{$lect_id}}"/>
        </div>
    </div>
      <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">课程分类</label>
      <div class="layui-input-inline">
        <select name="cate_id">
          <option value="">请选择分类</option>
            @foreach($infinitus as $v)
                <option value="{{$v['cate_id']}}"><?php echo str_repeat("|—",$v['leavel']+1);?>{{$v['cate_name']}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">是否收费</label>
    <div class="layui-input-block">
    <input type="radio" name="is_free" value="1" title="是">
      <input type="radio" name="is_free" value="2" title="否">
    </div>
  </div>

  <div class="layui-form-item">
        <label class="layui-form-label">课程价格</label>
        <div class="layui-input-inline">
            <input type="text" name="price" autocomplete="off" placeholder="请输入价格" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">课程状态</label>
    <div class="layui-input-block">
    <input type="radio" name="status" value="1" title="未开始">
      <input type="radio" name="status" value="2" title="连载中">
      <input type="radio" name="status" value="3" title="已完结">
    </div>
  </div>

    <div class="layui-form-item">
    <label class="layui-form-label">上下架</label>
    <div class="layui-input-block">
      <input type="radio" name="close" value="0" title="上架">
      <input type="radio" name="close" value="1" title="下架">
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-form-item">
        <label class="layui-form-label">课程图片</label>
        <div class="layui-input-inline">
            <input type="file" name="course_page" id="file">
        </div>
    </div>
    </div>
    <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">课程介绍</label>
    <div class="layui-input-block">
      <textarea placeholder="请输入内容" id="add" class="layui-textarea" name="introduce"></textarea>
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
        //alert(123);
        // var course_name=$('input[name=course_name]').val();
         var lect_id=$('input[name=lect_id]').val();
        // var is_free = $("input[name='is_free']:checked").val();
        // var status = $("input[name='status']:checked").val();
        // var close=$("input[name='close']:checked").val();
        // //var course_page=$('input[name=course_page]').val();
        // var price=$('input[name=price]').val();
        //var introduce = $('#add').val();
        //console.log(lect_id);
        //模拟表单对象
        var fd = new FormData($("#form")[0]);
        //获取到文件
        $.ajax({
            type:'POST',
            url:"{{url('admin/course_add_do')}}",
            data:fd,//
            dataType:'json',
            contentType:false,
            processData:false,
            success:function(res){
                if(res.code=1){
                    alert(res.msg);
                    location.href="/admin/course_list?lect_id="+lect_id;;
                }else{
                    alert(res.msg);
                    location.href="/admin/course_add?lect_id="+lect_id;;
                }
            }
        });
    });
</script>

@endsection



