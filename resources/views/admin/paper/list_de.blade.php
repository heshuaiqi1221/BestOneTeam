@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/lt_upd_warm_do" method="post">
        <h2>试卷内容</h2>
        <br>
        <hr>
        <br>

        @foreach($data as $v)
            @if ($v['type_id'] == 1)
                <p>
                    题目： {{$v['data'][0]['problem']}}
                </p>
                <input type="radio" class="a" name="single_answer"  value="1">
                <input type="hidden"  name="single_a_id" value="{{$v['data'][0]['id']}}">
                <input type="text"  name="single_a" placeholder="{{$v['data'][0]['answer']}}" value=""><br/>
                <input type="hidden" class="is_yesa" value="{{$v['data'][0]['is_answer']}}">
                <input type="radio" name="single_answer"  value="2">
                <input type="hidden" name="single_b_id" value="{{$v['data'][1]['id']}}">
                <input type="text" name="single_b" placeholder="{{$v['data'][1]['answer']}}" value=""><br/>
                <input type="radio" name="single_answer"  value="3">
                <input type="hidden" name="single_c_id" value="{{$v['data'][2]['id']}}">
                <input type="text" name="single_c" placeholder="{{$v['data'][2]['answer']}}" value=""><br/>
                <input type="radio" name="single_answer"  value="4">
                <input type="hidden" name="single_d_id" value="{{$v['data'][3]['id']}}">
                <input type="text" name="single_d" placeholder="{{$v['data'][3]['answer']}}" value=""><br/>
                <hr>
            @elseif ($v['type_id'] == 2)
                <input type="hidden" class="is_yes" value="{{$is_yes}}">
                <input type="hidden" name="single_a_id" value="{{$v['data'][0]['id']}}">
                <p>
                    题目： {{$v['data'][0]['problem']}}
                </p>
                <br/>
                A:<input type="checkbox" name="single_answer[]"  value="1">
                <input type="text" name="single_a" placeholder="{{$v['data'][0]['answer']}}"><br/>
                B:<input type="checkbox" name="single_answer[]"value="2">
                <input type="hidden" name="single_b_id" value="{{$v['data'][1]['id']}}">
                <input type="text" name="single_b"  placeholder="{{$v['data'][1]['answer']}}" ><br/>
                C:<input type="checkbox" name="single_answer[]"  value="3">
                <input type="hidden" name="single_c_id" value="{{$v['data'][2]['id']}}">
                <input type="text" name="single_c" placeholder="{{$v['data'][2]['answer']}}"><br/>
                D:<input type="checkbox" name="single_answer[]"  value="4">
                <input type="hidden" name="single_d_id" value="{{$v['data'][3]['id']}}">
                <input type="text" name="single_d" placeholder="{{$v['data'][3]['answer']}}"><br/>

            @elseif ($v['type_id']== 3)

                    <p>
                        题目： {{$v['data'][0]['problem']}}
                    </p>

                对:<input type="radio" name="is_yes" value="1">
                <input type="hidden" class="is_yes" value="{{$v['data'][0]['is_answer']}}">

                错:<input type="radio" name="is_yes" value="2">
                <br>
                <hr>
            @endif
        @endforeach
        <input type="hidden" name="id" value="">

    </form>

    <script>
//        var catelog_id = getUrlParam('id');
//        $("input[name=id]").attr("value",catelog_id);
var is_yesa= $('.is_yesa').val();
//        alert(is_yes);
$("input[value="+is_yesa+"]").attr("checked",'checked');


        var is_yes= $('.is_yes').val();
        //        alert(is_yes);
$("input[value="+is_yes+"]").attr("checked",'checked');
$("input[type=text]").attr("disabled",'disabled');
$("input[type=radio]").attr("disabled",'disabled');
$("input[type=checkbox]").attr("disabled",'disabled');
//        function getUrlParam(name) {
//            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
//            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
//            if (r != null) return decodeURI(r[2]); return null; //返回参数值
//        }
    </script>
@endsection











