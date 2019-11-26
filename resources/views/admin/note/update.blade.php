@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<h3 align="center">添加笔记</h3>
<form class="layui-form" action="/admin/note/note_update_do" method="post">
	<input type="hidden" name="note_id" value="{{$info->note_id}}">
    <div class="layui-form-item">
        <label class="layui-form-label">笔记的内容</label>
        <div class="layui-input-block">
            <input type="text" name="note_desc" lay-verify="title" autocomplete="off" placeholder="请输入咨询标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id="add" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection