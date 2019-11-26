@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/lt_upd_warm_do" method="post">
        <input type="hidden" name="type_id" value="3">
        <span>判断</span>
        <br/>
        题目：<input type="text" name="judge" value="{{$data[0]['problem']}}"><br/>
        对:<input type="radio" name="is_yes" value="1">
        <input type="hidden" class="is_yes" value="{{$data[0]['is_answer']}}">

        错:<input type="radio" name="is_yes" value="2">
        <input type="submit" name="sub" value="提交">
        <input type="hidden" name="id" value="">

    </form>

    <script>
        var catelog_id = getUrlParam('id');
        $("input[name=id]").attr("value",catelog_id);
        var is_yes= $('.is_yes').val();
        //        alert(is_yes);
        $("input[value="+is_yes+"]").attr("checked",'checked');
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return decodeURI(r[2]); return null; //返回参数值
        }
    </script>
@endsection











