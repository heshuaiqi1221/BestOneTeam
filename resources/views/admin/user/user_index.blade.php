@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <a href="/admin/user/user_create" class="layui-btn">添加用户</a>
    <table class="layui-table">
        <colgroup>
            <col width="50">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>邮箱</th>
            <th>所属角色</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
            <th>是否会员</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->users_name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->name}}</td>
                <td>@if($v->status==1)<span style="color:red;">禁用 <input type="checkbox" value="{{$v->status}}" class="frame" id="{{$v->id}}" checked/></span>@else <span style="color:yellow;">启用<input type="checkbox" class="frame" id="{{$v->id}}" value="{{$v->status}}"/></span>@endif</td>
                <td>{{date('Y-m-d',$v->created_time)}}</td>
                <td>
                    <a href="/admin/user/edit?id={{$v->id}}" class='layui-btn layui-btn-sm layui-btn-warm'>编辑</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $users->links() }}</div>
    <script>
    $(document).on('click','.frame',function(){
            //alert(111);
            var id = $(this).attr('id');
            var status = $(this).val();
            if(status==2){
                status = 1;
            }else{
                status = 2;
            }
            //console.log(status);
            //console.log(id);
            $.ajax({
                url:"/admin/user/status",
                data:{status:status,id:id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/user/user_index";
                    }
                }
            })
        })</script>
@endsection

