@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <form  action="/admin/ltem/danger_add" method="post">
        <input type="hidden" name="type_id" value="2">
        <span>多选</span><br/>
        题目：<input type="text" name="problem" value=""><br/>
        A:<input type="checkbox" name="single_answer[]" value="1">
        <input type="text" name="single_a"><br/>
        B:<input type="checkbox" name="single_answer[]" value="2">
        <input type="text" name="single_b"><br/>
        C:<input type="checkbox" name="single_answer[]" value="3">
        <input type="text" name="single_c"><br/>
        D:<input type="checkbox" name="single_answer[]" value="4">
        <input type="text" name="single_d"><br/>
        <input type="submit" name="sub" value="提交">
    </form>
@endsection











