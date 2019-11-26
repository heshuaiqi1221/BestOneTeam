@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/bank_add" method="post">
        <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;">
            <div>
                <button type="button" class="layui-btn redio">单选题</button>
                <button type="button" class="layui-btn layui-btn-warm">判断题</button>
                <button type="button" class="layui-btn layui-btn-danger">多选题</button>
            </div>
        </fieldset>
    </form>
<script type="text/javascript">
    $(document).on('click','.redio',function(){
        location.href="lt_radio";
    })
    $(document).on('click','.layui-btn-warm',function(){
        location.href="lt_warm";

    })
    $(document).on('click','.layui-btn-danger',function(){
        location.href="lt_danger";

    })
</script>
@endsection











