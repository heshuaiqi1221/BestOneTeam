@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">考试管理</h3>
    <p align="center">浏览次数.{{$exam_num}}</p>
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
                <th>考试指导标题id</th>
                <th>用户</th>
                <th>所属课程</th>
                <th>考试指导标题</th>
                <th>浏览次数</th>
                <th>考试指导内容</th>
                <th>考试时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($data as $k=>$v)
                <tr>
                    <td>{{ $v->exam_id}}</td>
                    <td>{{ $v->u_email }}</td>
                    <td>{{ $v->course_name }}</td>
                    <td>{{ $v->exam_title }}</td>
                    <td>{{ $v->exam_num }}</td>
                    <td>{{ $v->exam_content }}</td>
                    <td>{{date('Y-m-d H:i:s',$v->exam_time)}}</td>
                    <td>
                        <div class="layui-btn-group">
                            <a type="button" class="layui-btn" exam_id="{{ $v->exam_id }}" href="exam_update?exam_id={{ $v->exam_id }}&course_id={{$v->course_id}}">编辑</a>
                            <a type="button" class="layui-btn" exam_id="{{ $v->exam_id }}" href="exam_destroy?exam_id={{ $v->exam_id }}&course_id={{$v->course_id}}">删除</a>

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
