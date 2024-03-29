@extends('layouts.admin')

@section('content')
    <a href="/admin/user_index" class="layui-btn layui-btn-primary layui-btn-sm">返回</a>
    <hr>
    <form class="layui-form" action="/admin/user/user_create_do" method="POST" style="width: 800px;">
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
                <input type="text" name="users_name" required lay-verify="required|users_name" placeholder="请输入姓名"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" required lay-verify="required|email" placeholder="请输入邮箱"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" required lay-verify="required|pass" placeholder="请输入密码"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">6-20位</div>
        </div>
        <div class="layui-form-item" style="width: 500px;">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password_repeat" required lay-verify="required|same" placeholder="请输入相同的密码"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" checked>
                <input type="radio" name="status" value="2" title="禁用">
            </div>
        </div>
        <div class="layui-form-item" id="roles">
            <label class="layui-form-label">所属角色</label>
            <div class="layui-input-block">
                @foreach($roles as $role)
                    <input type="checkbox" name="r_id" value="{{ $role['id'] }}" title="{{ $role['name'] }}">
                @endforeach
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="submit" class="layui-btn" lay-submit lay-filter="formDemo" value="立即提交">
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        layui.use(['form', 'layer'], function () {
            var form = layui.form;
            var layer = layui.layer;

            form.verify({
                name: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                        return '姓名不能有特殊字符';
                    }
                    if (/(^\_)|(\__)|(\_+$)/.test(value)) {
                        return '姓名首尾不能出现下划线\'_\'';
                    }
                }
                , same: function (value, item) { //value：表单的值、item：表单的DOM对象
                    if (value !== $("input[name='password']").val()) {
                        return '两次填写的密码不一致';
                    }
                }

                //我们既支持上述函数式的方式，也支持下述数组的形式
                //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
                , pass: [
                    /^[\S]{6,20}$/
                    , '密码必须6到20位，且不能出现空格'
                ]
            });

            form.on('radio(admin)', function(data){
                console.log(data.elem); //得到radio原始DOM对象
                console.log(data.value); //被点击的radio的value值
                if(data.value === '1'){
                    $('#roles').hide();
                }else{
                    $('#roles').show();
                }
            });

        });
    </script>
@endsection