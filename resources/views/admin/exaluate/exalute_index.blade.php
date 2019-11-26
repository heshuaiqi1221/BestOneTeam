@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col>
    <col >
    <col >
    <col width="200">
  </colgroup>
  <thead>
    <tr>
      <th>课程id</th>
      <th>用户id</th>
      <th>评论内容</th>
      <th>浏览量</th>
      <th>评论时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  @foreach($info as $item)
      <tr>
  <td>{{$item['course_id']}}</td>
  <td>{{$item['u_id']}}</td>
  <td>{{$item['e_content']}}</td>
   <td>{{$item['e_num']}}</td>
   <td>{{date('Y-m-d H:i:s',$item['create_time'])}}</td>
   <td>
         <button type="button" e_id="{{$item['e_id']}}" class="layui-btn del layui-btn-warm">删除</button>
   </td>
      </tr>
  @endforeach
  </tbody>
</table>

<script>
    //layui.use(['layer','jquery','form'],function(){
    //var layer=layui.layer;//layui 弹框
    layui.use(['form', 'layedit', 'laydate'], function(){
        var layer=layui.layer;//layui 弹框
    });
</script>
<script>
  //删除问题
  $(document).on('click','.del',function(){
     var id=$(this).attr('e_id');
     console.log(id);
      $.ajax({
           url:"{{url('admin/exalute_del')}}",
           data:{id:id},
           dataType:'json',
           success:function(e){
              layer.msg(e.content,{icon:e.icon,time:2000});  
              window.location.reload();  
         }, 
       });
    });

  //});
</script>
@endsection