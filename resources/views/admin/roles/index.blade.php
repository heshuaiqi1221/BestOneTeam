@extends('layouts.admin')
@section('content')
    <a href="/admin/roles/roles_add" class="layui-btn">添加角色</a>
    <table class="layui-table">
        <colgroup>
            <col width="50">
            <col width="130">
            <col>
            <col width="110">
            <col width="115">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>权限组</th>
            <th>状态</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->q_id}}</td>
                <td>@if($v->is_del==1)<span style="color:red;">禁用 <input type="checkbox" value="{{$v->is_del}}" class="frame" id="{{$v->id}}" checked/></span>@else <span style="color:yellow;">启用<input type="checkbox" class="frame" id="{{$v->id}}" value="{{$v->is_del}}"/></span>@endif</td>
                <td>{{date("Y-m-d",$v->created_time)}}</td>
                <td><a href="/admin/roles/roles_edit?id={{$v->id}}" class='layui-btn layui-btn-sm layui-btn-warm'>编辑</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $roles->links() }}</div>
    <script>
    $(document).on('click','.frame',function(){
            //alert(111);
            var id = $(this).attr('id');
            var is_del = $(this).val();
            if(is_del==2){
                is_del = 1;
            }else{
                is_del = 2;
            }
            //console.log(is_del);
            //console.log(id);
            $.ajax({
                url:"/admin/roles/is_del",
                data:{is_del:is_del,id:id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else if(res.code==2){
                        alert(res.msg);
                        location.href="/admin/roles/roles_index";
                    }else{
                        alert(res.msg);
                        location.href="/admin/user/user_index";
                    }
                }
            })
        })</script>

@endsection

