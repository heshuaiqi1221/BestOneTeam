@extends('layouts.admin')

@section('content')
    @parent

<form>
    <div>
        <h1 align="center">会员列表</h1>

        <div class="">
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" align="center" name="uname" value="{{$uname}}" placeholder="请输入关键词" class="input-sm form-control"> <span>
                    <button class="btn btn-sm btn-primary" align="center"> 搜索</button> </span>
                </div>
                </div>
            </div>
        <table class="layui-table" align="center">
            <!-- <colgroup align="center">
              <col width="150" >
              <col width="200" >
              <col>
            </colgroup> -->
            <thead >
            <tr align="center">
                <th>编号</th>
                <th>会员名称</th>
                <th>会员年龄</th>
                <th>会员性别</th>
                {{--<th>课程图片</th>--}}
                <th>会员类型</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach ($data as $k=>$v)
            <tbody id="list" align="center">
                <td>{{$v->uid}}</td>
                <td>{{$v->uname}}</td>
                <td>@if($v['usex']==1)<span style='color:#ff0000;'>男</span>@else <span style='color:#ff0000;'>女</span>@endif</td>
                <td>{{$v->uage}}</td>
                {{--<td><img src="" width="60" height="60" /></td>--}}
                <td>@if($v['utype']==1)<span style='color:#ff0000;'>会员</span>@else <span style='color:#ff0000;'>已取消其会员</span>@endif</td>
                <td>
                    @if($v['queen_id']=='')
                    @if($v['utype']==1)<a href="/admin/vipupd?uid={{$v->uid}}&u_id={{$v->u_id}}" class='layui-btn layui-btn-sm layui-btn-warm'>设为非会员</a>&nbsp;@else <a href="/admin/vipupd?uid={{$v->uid}}&u_id={{$v->u_id}}" class='layui-btn layui-btn-sm layui-btn-warm'>设为会员</a>&nbsp;@endif
                    <a href='/admin/vipdel?uid={{$v->uid}}&u_id={{$v->u_id}}' class='layui-btn layui-btn-sm'>删除</a>
                    <a href='/admin/vipadd?u_id={{$v->u_id}}' class='layui-btn layui-btn-sm'>添加</a>
                    @else
                    @if($v['utype']==1)<a href="/admin/vipupd?uid={{$v->uid}}&id={{$v->id}}" class='layui-btn layui-btn-sm layui-btn-warm'>设为非会员</a>&nbsp;@else <a href="/admin/vipupd?uid={{$v->uid}}&u_id={{$v->u_id}}" class='layui-btn layui-btn-sm layui-btn-warm'>设为会员</a>&nbsp;@endif
                    <a href='/admin/vipdel?uid={{$v->uid}}&id={{$v->id}}' class='layui-btn layui-btn-sm'>删除</a>
                    <a href='/admin/vipadd?id={{$v->id}}' class='layui-btn layui-btn-sm'>添加</a>
                    @endif

                </td>
            </tbody>
            @endforeach
        </table>
    </div>
</form>
    {{$data->appends($query)->links()}}

<script>
layui.use(['form', 'layedit', 'laydate'], function(){
});
</script>

@endsection

