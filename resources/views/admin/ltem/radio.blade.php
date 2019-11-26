@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/bank_add" method="post">

            <span>单选题</span><br/>
        <input type="hidden" name="type_id" value="1">
            题目：<input type="text" name="problem" value=""><br/>
            A:<input type="radio" name="single_answer" value="1">
            <input type="text" name="single_a" value=""><br/>
            B:<input type="radio" name="single_answer" value="2">
            <input type="text" name="single_b" value=""><br/>
            C:<input type="radio" name="single_answer" value="3">
            <input type="text" name="single_c" value=""><br/>
            D:<input type="radio" name="single_answer" value="4">
            <input type="text" name="single_d" value=""><br/>
        <input type="submit" name="sub" value="提交">
    </form>
@endsection











