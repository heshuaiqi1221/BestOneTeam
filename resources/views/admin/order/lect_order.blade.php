@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">{{$lect_name}}讲师收益情况</h3>
    <div class="layui-form">
        <span style="color: #1be611">此讲师总收益：{{$merge}}</span>
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
                <th>课程名称</th>
                <th>讲师名称</th>
                <th>用户邮箱</th>
                <th>原价</th>
                <th>活动</th>
                <th>支付价格</th>
                <th>讲师可得收益</th>
                <th>记录时间</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($date as $k=>$v)
            <tr>
                <td>{{ $v['order_id'] }}</td>
                <td>{{ $v['course_name'] }}</td>
                <td>{{ $v['lect_name'] }}</td>
                <td>{{ $v['u_email'] }}</td>
                <td><span style="color:blue;">{{$v['price']}}￥</span></td>
                <td>@if($v['act_id']==0)无活动@else已参加活动@endif</td>
                <td><span style="color:red;">{{$v['pay_price']}}￥</span></td>
                <td><span style="color:red;">约{{$v['pay_price'] * 0.7}}￥</span></td>
                <td>{{date('Y-m-d H:i:s',$v['o_time'])}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
        {{ $date ->appends($query)->links() }}
        </div>

    </div>

@endsection
