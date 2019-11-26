@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <fieldset class="layui-elem-field layui-field-title" style:margin-top: 20px;>
        <legend align="center">用户详情</legend>
    </fieldset>

    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>详情ID</th>
                <th>用户邮箱</th>
                <th>头像</th>
                <th>年龄</th>
                <th>性别</th>
                <th>操作</th>
                <th>效果</th>
            </tr>
            </thead>
            <tbody id="list">

                @if($data)
                    @foreach($data as $v)
                        <tr align="center" user_info_id={{$v->user_info_id}}>
                            <td>{{$v->user_info_id}}</td>
                            <td>{{$v->u_email}}</td>
                            <td><img src="http://{{$name}}/{{$v->u_head}}" width="100"></td>
                            <td>{{$v->u_age}}</td>
                            <td>@if($v['u_sex']==1)男@else 女@endif</td>
                            <td class="del">
                                <button class='layui-btn layui-btn-sm layui-btn-warm' id="{{$v->user_info_id}}">删除</button>
                            </td>
                            <td>@if($v->is_status==1)
                            <span style="color:red;" class="frame" is_status="{{$v->is_status}}" u_id="{{$v->u_id}}">禁用</span>
                            @else
                            <span style="color:green;" class="frame" is_status="{{$v->is_status}}" u_id="{{$v->u_id}}">启用</span>
                            @endif
                            @if($v->upgrade==1)
                            <span style="color:#ccff00;" class="clor" upgrade="{{$v->upgrade}}" u_id="{{$v->u_id}}">升级为会员</span>
                            @else
                            <span style="color:#ccff00;" class="clor" upgrade="{{$v->upgrade}}" u_id="{{$v->u_id}}">取消其资格</span>
                            @endif
                            @if($v->lect==1)
                            <span style="color:red;" class="lect" lect="{{$v->lect}}" u_id="{{$v->u_id}}">升级为讲师</span>
                            @elseif($v->lect==2)
                            <span style="color:yellow;">正在审核</span>
                            @else
                            <span style="color:red;">请去公司面试</span>
                            @endif
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>


<script type="text/javascript" src="/js/jquery.min.js"></script>
<script>
    $(function(){
        //点击删除
        $(document).on('click','.del',function(){
            var _this=$(this);
            var user_info_id=_this.parents('tr').attr('user_info_id');
            if(!user_info_id){
                alert('请选择一条记录');
            }
            //把商品id传给控制器
            $.post(
                "{{url('admin/destroy')}}",
                {user_info_id:user_info_id},
                function(res){
                    window.location.href="/admin/user_desc_list";
                }
            );
        }),'json'
        });
    $(document).on('click','.frame',function(){
            //alert(111);
            var u_id = $(this).attr('u_id');
            var is_status = $(this).attr('is_status');
            if(is_status==2){
                is_status = 1;
            }else{
                is_status = 2;
            }
            //console.log(is_status);
            //console.log(u_id);return;
            $.ajax({
                url:"/admin/user_desc/is_status",
                data:{is_status:is_status,u_id:u_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/user_desc_list";
                    }
                }
            })
        });
    $(document).on('click','.clor',function(){
            //alert(111);
            var u_id = $(this).attr('u_id');
            var upgrade = $(this).attr('upgrade');
            if(upgrade==2){
                upgrade = 1;
            }else{
                upgrade = 2;
            }
            //console.log(upgrade);
            //console.log(u_id);return;
            $.ajax({
                url:"/admin/upgrade",
                data:{upgrade:upgrade,u_id:u_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/user_desc_list";
                    }
                }
            })
        });
        $(document).on('click','.lect',function(){
            //alert(111);
            var u_id = $(this).attr('u_id');
            var lect = $(this).attr('lect');
            if(lect==2){
                lect = 1;
            }else{
                lect = 2;
            }
            //console.log(lect);
            //console.log(u_id);return;
            $.ajax({
                url:"/admin/lect",
                data:{lect:lect,u_id:u_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/user_desc_list";
                    }
                }
            })
        })

</script>

@endsection