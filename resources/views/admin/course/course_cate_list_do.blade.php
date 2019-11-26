@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<form action="">
    <div>
        <h1 align="center">课程列表</h1>
        <div style="margin-bottom: 20px;"></div>
        <div class="">
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" name="cate_name" value="{{$cate_name}}" placeholder="请输入关键词" class="input-sm form-control"> <span>
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
                <th>编号</th>
                <th>分类名称</th>
                <th>备注</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach ($data as $k=>$v)
            <tbody id="list" align="center">

                <td>{{$v->cate_id}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{$v->cate_describe}}</td>
                <td><div class="layui-form-item">
                <label class="layui-form-label">@if($v['is_del']==1)禁用@else 启用@endif</label>
                <div class="layui-input-block">
                  <input type="checkbox" class="block" @if($v['is_del']==1)checked="" @endif  value="{{$v->is_del}}" name="is_del" cate_id="{{$v->cate_id}}" lay-skin="switch" lay-filter="switchTest" lay-text="ON|OFF">
                </div>
              </div>
                </td>
                <td><a href="/admin/course_cate_update?cate_id={{$v->cate_id}}" class='btn layui-btn layui-btn-sm'>编辑</a>&nbsp;<a href='/admin/course_cate' class='layui-btn layui-btn-sm'>添加</a></td>

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
    // 删除
        $(document).on('click','.block',function(){
            //alert(111);
            var cate_id = $(this).attr('cate_id');
            var is_del = $(this).val();

            if(is_del==1){
                is_del = 2;
            }else{
                is_del = 1;
            }
            //console.log(is_del);
            //console.log(cate_id);
            $.ajax({
                url:"/admin/course_cate_del",
                data:{is_del:is_del,cate_id:cate_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                    }else if(res.code==2){
                        alert(res.msg);
                        location.href="/admin/course_cate_list";
                    }else{
                        alert(res.msg);
                        location.href="/admin/course_list";
                    }
                    // alert(res.msg);
                    // location.href="http://www.education.com/admin/course_cate_list";
                }
            })
        })
</script>

@endsection

