@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<h3 align="center">咨询添加</h3>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<form class="layui-form" action="/admin/information/info_add_do" method="post">
    <div class="layui-form-item">
        <label class="layui-form-label">咨询标题</label>
        <div class="layui-input-block">
            <input type="text" name="info_title" lay-verify="title" autocomplete="off" placeholder="请输入咨询标题" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-form-text">
        <script id="editor" type="text/plain" style="width:95%;height:500px;" name="info_content">

        </script>

    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id="add" type="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    var ue = UE.getEditor('editor');
</script>
@endsection
