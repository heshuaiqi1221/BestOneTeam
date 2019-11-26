@extends('layouts.admin')

@section('content')
    <a href="/admin/roles/roles_index" class="layui-btn layui-btn-primary layui-btn-sm">返回</a>
    <hr>
    <form class="layui-form" action="/admin/roles/roles_edit_do" method="POST" style="width: 900px;">
        <div class="layui-form-item" style="width: 400px;">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" value="{{$roles[0]['name']}}" required lay-verify="required" placeholder="请输入角色名称"
                       autocomplete="off" class="layui-input">
                    <input type="hidden" name="id" value="{{$roles[0]['id']}}" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限组</label>
            <div class="layui-input-block">
                @foreach($menu as $v)
                    <input type="checkbox" name="q_id[]" value="{{$v['id']}}" title="{{$v['name']}}">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input class="layui-btn" lay-submit lay-filter="formDemo" type="submit" value="修改">
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



