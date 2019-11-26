@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<form>
    <div>
        <h1 align="center">课程列表</h1>

        <div class="">
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" name="course_name" value="{{$course_name}}" placeholder="请输入关键词" class="input-sm form-control"> <span>
                    <button class="btn btn-sm btn-primary"> 搜索</button> </span>
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
                <th>课程名称</th>
                <th>课程分类</th>
                <th>课程图片</th>
                <th>是否收费</th>
                <th>课程价格</th>
                <th>上下架</th>
                <th>课程状态</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach ($data as $k=>$v)
            <tbody id="list" align="center">
                <td>{{$v->course_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td><img src="http://{{$name}}/{{$v->course_page}}" width="60" height="60" /></td>
                <td>@if($v['is_free']==1)<span style='color:#ff0000;'>收费</span>@else <span style='color:#ff0000;'>免费</span>@endif</td>
                <td>{{$v->price}}</td>
                <td>@if($v['close']==1) 点击上架 <input type="checkbox" class="frame"  value="{{$v->close}}" name="close" lect_id="{{$v->lect_id}}" course_id="{{$v->course_id}}" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">@elseif($v['close']==0)<span style='color:#ffcc00;'>正在审核</span> @else <span style='color:#ff0000;'>已成功上架</span> @endif
              </td>

                <td>@if($v['status']==1)<span style='color:#ffcc00;'>未开始</span>@elseif($v['status']==2)<span style='color:#00ff00;'>连载中</span> @else<span style='color:#ff0000;'>已完结</span> @endif</td>
                <td><a href="/admin/course_update?course_id={{$v->course_id}}&lect_id={{$v->lect_id}}" class='btn layui-btn layui-btn-sm'>编辑</a>&nbsp;<a href='/admin/course_del?course_id={{$v->course_id}}&lect_id={{$v->lect_id}}' class='layui-btn layui-btn-sm layui-btn-warm'>删除</a><a href="/admin/catelog/index?course_id={{$v->course_id}}" class='btn layui-btn layui-btn-sm'>添加章节</a><a href="/admin/catelog/list?id={{$v->course_id}}" class='btn layui-btn layui-btn-sm'>章节列表</a><a href="/admin/exalute_add?course_id={{$v->course_id}}" class='layui-btn layui-btn-sm layui-btn-warm'>添加评论</a><a href="/admin/exalute_index?course_id={{$v->course_id}}" class='btn layui-btn layui-btn-sm'>课程评论</a><a href="/admin/collect_add?course_id={{$v->course_id}}" class='layui-btn layui-btn-sm layui-btn-warm'>收藏</a><a href="/admin/exam_list?id={{$v->course_id}}" class='btn layui-btn layui-btn-sm  layui-btn-warm'>查看考试</a><a type="button" class="layui-btn layui-btn-sm"  href="exam_add?course_id={{$v->course_id}}">添加考试</a>
                <a href="/admin/lect_order?course_id={{$v->course_id}}&lect_id={{$v->lect_id}}" class='layui-btn layui-btn-sm'>收益详情</a>
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
<script>
        //上下架
        $(document).on('click','.frame',function(){
            //alert(111);
            var course_id = $(this).attr('course_id');
            var lect_id = $(this).attr('lect_id');
            var close = $(this).val();

            if(close==0){
                close = 1;
            }else{
                close = 0;
            }
            //console.log(close);
            //console.log(course_id);
            $.ajax({
                url:"/admin/give_or_take",
                data:{close:close,course_id:course_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                        location.href="/admin/course_list?lect_id="+lect_id;
                    }
                    // alert(res.msg);
                    // location.href="http://www.education.com/admin/course_cate_list";
                }
            })
        })
</script>



@endsection

