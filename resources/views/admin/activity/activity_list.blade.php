@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">活动模块</h3>
    <p align="center">浏览次数.{{$act_hot}}</p>
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
                <th>活动id</th>
                <th>活动标题</th>
                <th>课程名称</th>
                <th>浏览次数</th>
                <th>活动内容</th>
                <th>活动时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($data as $k=>$v)
                <tr>
                    <td>{{ $v->act_id }}</td>
                    <td>{{ $v->act_title }}</td>
                    <td>{{ $v->course_name }}</td>
                    <td>{{ $v->act_hot }}</td>
                    <td>{{ $v->act_content }}</td>
                    <td>{{date('Y-m-d H:i:s',$v->act_time)}}</td>
                    <td>
                        <div class="layui-btn-group">
                            <a type="button" class="layui-btn" act_id="{{ $v->act_id }}" href="activity_update?act_id={{ $v->act_id }}">编辑</a>
                            <a type="button" class="layui-btn" act_id="{{ $v->act_id }}" href="activity_destroy?act_id={{ $v->act_id }}">删除</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
