@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <table class="layui-table">
        <colgroup>
            <col width="50">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>用户邮箱</th>
            <th>用户名称</th>
            <th>用户头像</th>
            <th>用户性别</th>
            <th>用户年龄</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lect as $v)
            <tr>
                <td>{{$v->u_id}}</td>
                <td>{{$v->u_email}}</td>
                <td>{{$v->u_name}}</td>
                <td><img src="http://{{$name}}/{{$v->u_head}}" width="100"></td>
                <td>@if($v['u_sex']==1)男@else女@endif</td>
                <td>{{$v->u_age}}</td>
                <td>{{date('Y-m-d',$v->u_time)}}</td>
                <td>@if($v->lect==2)<span style="color:red;">提升为讲师 <input type="checkbox" value="{{$v->lect}}" class="frame" u_id="{{$v->u_id}}" /></span>@else <span style="color:yellow;">已审核</span>@endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $lect->links() }}</div>
    <script>
    $(document).on('click','.frame',function(){
            //alert(111);
            var u_id = $(this).attr('u_id');
            var lect = $(this).val();
            if(lect==2){
                lect = 3;
            }
            //console.log(lect);
            //console.log(u_id);
            $.ajax({
                url:"/admin/lect_audit_close",
                data:{lect:lect,u_id:u_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/lect_audit";
                    }
                }
            })
        })</script>
@endsection

