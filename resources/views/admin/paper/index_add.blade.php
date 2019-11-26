@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>添加</title>
</head>
<body>
<h1>试卷添加</h1>
<br/>
<form action="/admin/paper/add_do" method="post" >
            <table class="layui-table" align="center">
                <h4>
                    试卷名称:         <input type="text" name="paper_name" value="">

                </h4>
                    <h4 class="layui-form-label">试卷分类</h4>
                <select name="cate_id">
                    <option value="">请选择分类</option>
                    @foreach($data as $v)
                        <option value="{{$v['cate_id']}}"><?php echo str_repeat("|—",$v['leavel']+1);?>{{$v['cate_name']}}</option>
                    @endforeach
                </select>
                <thead >
                <tr align="center">
                    <th></th>
                    <th>题目名称</th>
                    <th>试题分类</th>
                </tr>
                </thead>
                @foreach ($date as $k=>$v)
<tr>
                    <td>
                        {{--<input type="hidden" name="id" value="{{$v['id']}}">--}}
                        <input type="checkbox" name="single[]"  value="{{$v['id']}}">

                    </td>
                    <td>{{$v['problem']}}</td>
                    <td>
                        @if ($v['type_id'] == 1)
                            单选
                        @elseif ($v['type_id'] == 2)
                            多选
                        @elseif ($v['type_id']== 3)
                            判断
                    </td>
                    @endif
</tr>
                @endforeach
    <tr>  <td>
            <input type="submit" value="提交">
        </td> </tr>
            </table>

</form>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
    });
</script>
@endsection



