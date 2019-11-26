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
            <th>课程名称</th>
            <th>讲师名称</th>
            <th>课程介绍</th>
            <th>课程价格</th>
            <th>创建时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($course as $v)
            <tr>
                <td>{{$v->course_id}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->lect_name}}</td>
                <td>{{$v->introduce}}</td>
                <td>{{$v->price}}￥</td>
                <td>{{date('Y-m-d',$v->create_time)}}</td>
                <td>@if($v->close==0)<span style="color:red;">请通过 <input type="checkbox" value="{{$v->close}}" class="frame" course_id="{{$v->course_id}}" /></span>
                    @else
                        <span style="color:red;">已审核 <input type="checkbox" value="{{$v->close}}" class="frame" course_id="{{$v->course_id}}" checked/>
                    @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $course->links() }}</div>
    <script>
    $(document).on('click','.frame',function(){
            //alert(111);
            var course_id = $(this).attr('course_id');
            var close = $(this).val();
            if(close==0){
                close = 2;
            }else{
                close=0;
            }
            //console.log(close);
            //console.log(course_id);
            $.ajax({
                url:"/admin/course_audit_close",
                data:{close:close,course_id:course_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/course_audit";
                    }
                }
            })
        })</script>
@endsection

