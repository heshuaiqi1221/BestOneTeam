@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/warm_add" method="post">
        <input type="hidden" name="type_id" value="3">
        <span>判断</span>
        <br/>
        题目：<input type="text" name="judge" value=""><br/>
        对:<input type="radio" name="judge_answer" value="1">

        错:<input type="radio" name="judge_answer" value="2">
        <input type="submit" name="sub" value="提交">
    </form>
@endsection











