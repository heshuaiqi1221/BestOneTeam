@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<h3 align="center">咨询修改</h3>
<form class="layui-form" action="/admin/information/info_update_do" method="post">
	<input type="hidden" name="info_id" value="{{$info[0]['info_id']}}">
    <div class="layui-form-item">
        <label class="layui-form-label">咨询标题</label>
        <div class="layui-input-block">
            <input type="text" name="info_title" lay-verify="title" autocomplete="off" placeholder="请输入咨询标题" value="{{$info[0]['info_title']}}" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">咨询内容</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="info_content" class="layui-textarea">{{$info[0]['info_content']}}</textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id="add" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection