@extends('layouts.admin')

@section('content')
    <a href="/admin/user_index" class="layui-btn layui-btn-primary layui-btn-sm">返回</a>
    <hr>
    <form class="layui-form" action="/admin/user/edit_do" method="POST" style="width: 800px;">
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
                <input type="text" name="users_name"  placeholder="请输入姓名" value="{{$data[0]['users_name']}}" class="layui-input">
                <input type="hidden" name="id" value="{{$data[0]['id']}}"/>
            </div>
        </div>
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email"  placeholder="请输入邮箱"
                    value="{{$data[0]['email']}}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
            @if($data[0]['status']==1)
                <input type="radio" name="status" value="1" title="启用" checked>
                <input type="radio" name="status" value="2" title="禁用">
            @else
                <input type="radio" name="status" value="1" title="启用">
                <input type="radio" name="status" value="2" title="禁用" checked>
            @endif
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="修改">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
    <script>
        layui.use(['form', 'layer'], function () {
            var form = layui.form;
            var layer = layui.layer;
        });
    </script>
@endsection



