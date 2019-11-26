@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">总订单</h3>
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
                <th>id</th>
                <th>用户名称</th>
                <th>订单编号</th>
                <th>讲师名称</th>
                <th>原价</th>
                <th>活动</th>
                <th>现价</th>
                <th>公司收益</th>
                <th>课程名称</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($data1 as $k=>$v)
            <tr>
                <td>{{$v['order_id']}}</td>
                <td>{{ $v['u_email'] }}</td>
                <td>{{$v['order_mark']}}</td>
                <td>{{ $v['lect_name'] }}</td>
                <td><span style="color:blue;">{{$v['price']}}￥</span></td>
                <td>@if($v['act_id']==0)无活动@else已参加活动@endif</td>
                <td><span style="color:red;">{{$v['pay_price']}}￥</span></td>
                <td><span style="color:red;">约{{$v['pay_price'] * 0.3}}￥</span></td>
                <td>{{$v['course_name']}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
        {{ $data1 ->links() }}
        </div>

    </div>
@endsection
