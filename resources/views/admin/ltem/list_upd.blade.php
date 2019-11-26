@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/lt_upd_do" method="post">

        <span>单选题</span><br/>
        <input type="hidden" name="type_id" value="1">
        题目：<input type="text" name="problem" value="{{$data[0]['problem']}}"><br/>
        <input type="radio" name="single_answer"  value="1">
        <input type="hidden" name="single_a_id" value="{{$data[0]['id']}}">
        <input type="text"  name="single_a" placeholder="{{$data[0]['answer']}}" value=""><br/>
        <input type="hidden" class="is_yes" value="{{$data[0]['is_answer']}}">
        <input type="radio" name="single_answer"  value="2">
        <input type="hidden" name="single_b_id" value="{{$data[1]['id']}}">
        <input type="text" name="single_b" placeholder="{{$data[1]['answer']}}" value=""><br/>
        <input type="radio" name="single_answer"  value="3">
        <input type="hidden" name="single_c_id" value="{{$data[2]['id']}}">
        <input type="text" name="single_c" placeholder="{{$data[2]['answer']}}" value=""><br/>
        <input type="radio" name="single_answer"  value="4">
        <input type="hidden" name="single_d_id" value="{{$data[3]['id']}}">
        <input type="text" name="single_d" placeholder="{{$data[3]['answer']}}" value=""><br/>
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











