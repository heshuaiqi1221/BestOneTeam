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
            <input type="text" value="{{$data[0]['course_name']}}" name="course_name" autocomplete="off" placeholder="请输入姓名" class="layui-input">
            <input type="hidden" value="{{$data[0]['course_id']}}" name="course_id"/>
            <input type="hidden" value="{{$data[0]['lect_id']}}" name="lect_id"/>
        </div>
    </div>
      <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">课程分类</label>
      <div class="layui-input-inline">
        <select name="cate_id">
          <option>请选择分类</option>
            @foreach($infinitus as $v)
                <option @if($data[0]['cate_id']==$v['cate_id'])selected @endif value="{{$v['cate_id']}}"><?php echo str_repeat("|—",$v['leavel']+1);?>{{$v['cate_name']}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">是否收费</label>
    <div class="layui-input-block">
    <input type="radio" name="is_free" @if($data[0]['is_free']==1)checked @endif value="1" title="是">
      <input type="radio" name="is_free" @if($data[0]['is_free']==2)checked @endif value="2" title="否">
    </div>
  </div>
  <div class="layui-form-item">
        <label class="layui-form-label">课程价格</label>
        <div class="layui-input-inline">
            <input type="text" name="price" value="{{$data[0]['price']}}" autocomplete="off" placeholder="请输入价格" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
    <label class="layui-form-label">课程状态</label>
    <div class="layui-input-block">
    <input type="radio" name="status" @if($data[0]['status']==1)checked @endif value="1" title="未开始">
      <input type="radio" name="status" @if($data[0]['status']==2)checked @endif value="2" title="连载中">
      <input type="radio" name="status" @if($data[0]['status']==3)checked @endif value="3" title="已完结">
    </div>
  </div>

    <div class="layui-form-item">
    <label class="layui-form-label">上下架</label>
    <div class="layui-input-block">
      <input type="radio" name="close" @if($data[0]['close']==0)checked @endif value="0" title="上架">
      <input type="radio" name="close" @if($data[0]['close']==1)checked @endif value="1" title="下架">
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
      <textarea placeholder="请输入内容" id="add" class="layui-textarea" name="introduce">{{$data[0]['introduce']}}</textarea>
    </div>
  </div>
    <div class="layui-form-item">
        <button type="button" class="abb layui-btn layui-btn-normal">修改</button>
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
        // var cate_id=$('select[name=cate_id]').val();
        // var is_free = $("input[name='is_free']:checked").val();
        // var status = $("input[name='status']:checked").val();
        // var close=$("input[name='close']:checked").val();
        // //var course_page=$('input[name=course_page]').val();
        // var price=$('input[name=price]').val();
        //var introduce = $('#add').val();
        var lect_id=$('input[name=lect_id]').val();
        //模拟表单对象
        var fd = new FormData($("#form")[0]);
        //获取到文件
        $.ajax({
            type:'POST',
            url:'/admin/course_update_do',
            data:fd,//
            dataType:'json',
            contentType:false,
            processData:false,
            success:function(res){
                if(res.code=0){
                    alert(res.msg);
                    location.href="/admin/course_list?lect_id="+lect_id;
                }else{
                    alert(res.msg);
                    location.href="/admin/course_list?lect_id="+lect_id;
                }
            }
        });
    });
</script>

@endsection



