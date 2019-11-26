@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">笔记模块</h3>
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
                <th>笔记id</th>
                <th>用户邮箱</th>
                <th>课程名称</th>
                <th>笔记内容</th>
                <th>记录时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($date as $k=>$v)
            <tr>
                <td>{{ $v->note_id }}</td>
                <td>{{ $v->u_email }}</td>
                <td>{{ $v->course_name }}</td>
                <td>{{ $v->note_desc }}</td>
                <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                <td>
                    <div class="layui-btn-group">
                        <a type="button" class="layui-btn" note_id="{{ $v->note_id }}" href="/admin/note/note_update?note_id={{ $v->note_id }}">编辑</a>
                        <a type="button" class="layui-btn" note_id="{{ $v->note_id }}" href="/admin/note/note_del?note_id={{ $v->note_id }}">删除</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
        </div>

    </div>
@endsection
