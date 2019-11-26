@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<table class="layui-table">
  <colgroup>
    <col width="50">
    <col>
    <col>
    <col>
    <col>
    <col width="120">
  </colgroup>
  <thead>
    <tr>
      <th></th>
      <th>用户ID</th>
      <th>课程名称</th>
      <th>问题</th>
      <th>浏览量</th>
      <th>提问时间</th>
      <th>删除</th>
    </tr>
  </thead>
  <tbody>


   @foreach($info as $item)
   <div>
  <tr cate_pid="" cate_id="">
      <td><a class="sh" href="javascript:void(0)">+</a></td>
      <td>{{$item['u_id']}}</td>
      <td>{{$item['course_name']}}</td>
      <td>{{$item['title']}}</td>
      <td>{{$item['browse']}}</td>
      <td>{{date('Y-m-d H:i:s',$item['time'])}}</td>
      <td>
        <div class="layui-btn-group">
      <button class="layui-btn layui-btn-sm">
        <i class="layui-icon  del"   issue_id="{{$item['issue_id']}}">删除该问题</i>
      </button>
      <button class="layui-btn layui-btn-sm edit">
        <i class=" quest  layui-icon"  >回答该问题</i>
      </button>
    </div>
      </td>
   </tr>

  <tr   style="display: none">
    <td colspan="7">
   <div class="layui-form-item layui-form-text">
   <i class="layui-icon layui-icon-login-wechat" style="font-size: 30px; color: #1E9FFF;">u_id</i>
    <div class="layui-input-block">
      <textarea name="content" placeholder="请输入内容" class="layui-textarea"></textarea>
       <button class="layui-btn layui-btn-sm edit">
        <i class="layui-icon sub"  u_id="{{$item['u_id']}}" issue_id="{{$item['issue_id']}}" course_id="{{$item['course_id']}}"  >提交</i>
      </button>
    </div>
  </div>
  </td>
  </tr>
  </div>
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
    //点击回答该问题
    $(document).on('click','.quest',function(){
        //alert(111);
      $(this).parents('tr').next('tr').show();
    });

    //点击提交内容发送后台添加。
  $(document).on('click','.sub',function(){
        var u_id=$(this).attr('u_id');//获取用户id
        var course_id=$(this).attr('course_id');//获取课程id
        var issue_id=$(this).attr('issue_id');//获取问题id
        var content=$("[name='content']").val();
        $.ajax({
           url:"{{url('admin/resposen_add')}}",
           data:{u_id:u_id,course_id:course_id,issue_id:issue_id,content:content},
           dataType:'json',
           success:function(data){
              layer.msg(data.content,{icon:data.icon,time:2000},function(){
                window.location.reload();//页面重新加载
            });

         },
   });


    });


  //删除问题
  $(document).on('click','.del',function(){
     var issue_id=$(this).attr('issue_id');
     // console.log(issue_id);
      $.ajax({
           url:"{{url('admin/questions_del')}}",
           data:{issue_id:issue_id},
           dataType:'json',
           success:function(e){
              layer.msg(e.content,{icon:e.icon,time:2000});
               location.href="{{url('admin/question_list')}}";
         },
       });
    });

  //});

</script>


@endsection