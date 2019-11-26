@extends('layouts.admin')

@section('content')
    @parent

    <fieldset class="layui-elem-field layui-field-title" style:margin-top: 20px;>
        <legend align="center">收藏列表</legend>
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
                <th>ID</th>
                <th>课程名称</th>
                <th>用户名</th>
                <th>收藏夹</th>
                <th>收藏时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @if($data)
                @foreach($data as $v)
                    <tr align="center">
                        <td>{{$v->collect_id}}</td>
                        <td>{{$v->course_name}}</td>
                        <td>{{$v->u_email}}</td>
                        <td>{{$v->f_id}}号收藏夹</td>
                        <td>{{date('Y-m-d',$v->create_time)}}</td>
                        <td>
                            <a href="/admin/collect_destroy?collect_id={{$v->collect_id}}" class='layui-btn layui-btn-sm layui-btn-warm'  >删除</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>


    <script>
        // $(function(){
        //     //点击删除
        //     //$('.del').click(function(){
        //     $(document).on('click','.del',function(){
        //         var _this=$(this);
        //         var collect_id=_this.attr('id');

        //         //把商品id传给控制器
        //         $.post(
        //             "{{url('/admin/destroy')}}",
        //             {collect_id:collect_id},
        //             function(res){
        //                 window.location.href="/admin/collect_list";
        //             }
        //         );
        //     }),'json'
        // });
    </script>
@endsection


