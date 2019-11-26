@extends('layouts.admin')

@section('content')
    <table class="layui-table">
        <colgroup>
            <col width="50">
            <col width="120">
            <col width="80">
            <col width="100">
            <col>
            <col>
            <col width="120">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>登录人</th>
            <th>ip</th>
            <th>请求方式</th>
            <th>执行sql</th>
            <th>操作时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
        <tr>
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>{{$v['ip']}}</td>
            <td>{{$v['method']}}</td>
            <td>{{$v['sql']}}</td>
            <td>{{date('Y-m-d H:i:s',$v['time'])}}</td>
            <td><a href="/admin/operationLog/del?id={{$v['id']}}"  class='layui-btn layui-btn-sm'>删除</a></td>
        </tr>
        @endforeach
        </tbody>
    </table>




@endsection