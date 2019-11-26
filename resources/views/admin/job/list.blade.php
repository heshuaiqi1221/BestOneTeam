@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">作业模块</h3>
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
                <th>作业id</th>
                <th>课程名称</th>
                <th>章节名称</th>
                <th>作业名称</th>
                <th>作业内容</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($date as $k=>$v)
            <tr>
                <td>{{ $v->job_id }}</td>
                <td>{{ $v->course_name }}</td>
                <td>{{ $v->catelog_name }}</td>
                <td>{{ $v->job_name }}</td>
                <td>{{ $v->job_content }}</td>
                <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                <td>
                    <div class="layui-btn-group">
                        <a type="button" class="layui-btn" href="/admin/job/job_update?job_id={{ $v->job_id }}&id={{$v->catelog_id}}&course_id={{$v->course_id}}">编辑</a>
                        <a type="button" class="layui-btn" href="/admin/job/job_del?job_id={{ $v->job_id }}&id={{$v->catelog_id}}&course_id={{$v->course_id}}">删除</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
            {{ $date ->appends($query)->links() }}
        </div>


    </div>
@endsection
