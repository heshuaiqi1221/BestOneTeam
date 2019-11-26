@extends('layouts.admin')

@section('content')
    @parent

    <form>
        <div>
            <h1 align="center">会员列表</h1>

            <div class="">
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
                    <th>会员邮箱</th>
                    <th>会员年龄</th>
                    <th>会员性别</th>
                    {{--<th>课程图片</th>--}}
                    <th>操作</th>
                </tr>
                </thead>
                @foreach ($data as $k=>$v)
                    <tbody id="list" align="center">
                    <td>{{$v->u_id}}</td>
                    <td>{{$v->u_name}}</td>
                    <td>{{$v->u_email}}</td>
                    <td>{{$v->u_age}}</td>
                    <td>@if($v['u_sex']==1)男@else女@endif</td>
                    <td><a type="button" class="layui-btn" href="/admin/quit_user_vip?u_id={{$v->u_id}}">取消会员资格</a></td>
                    </tbody>
                @endforeach
            </table>
        </div>
    </form>
    {{$data->links()}}

    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
        });
    </script>

@endsection

