@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <form>
        <div>
            <h1 align="center">试卷列表</h1>

            <table class="layui-table" align="center">
                <!-- <colgroup align="center">
                  <col width="150" >
                  <col width="200" >
                  <col>
                </colgroup> -->
                <thead >
                <tr align="center">
                    <th>试卷名称</th>
                    <th>试卷分类</th>
                    <th>操作</th>
                </tr>
                </thead>
                @foreach ($data as $k=>$v)
                    <tr id="list" align="center">
                    <td>{{$v['paper_name']}}</td>
                    <td>{{$v['cate_name']}}</td>
                    <td><a href="/admin/paper/list_de?id={{$v['problem_id']}}" class='btn layui-btn layui-btn-sm'>详细</a>
                        <a href="/admin/paper/pa_del?id={{$v['paper_id']}}" class='btn layui-btn layui-btn-sm'>删除</a></td></td>
                    </tr>

                @endforeach
            </table>
        </div>
    </form>
    <script>
        layui.use(['form', 'layedit', 'laydate'], function(){
        });
    </script>


@endsection

