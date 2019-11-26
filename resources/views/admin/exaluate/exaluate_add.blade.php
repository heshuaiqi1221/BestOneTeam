@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<body >
<h2><b>评论添加</b></h2>

<form action="{{url('admin/exaluate_doadd')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">评论内容</label>
        <input type="text" id="name" name="e_content" class="form-control" id="exampleInputEmail1" placeholder="请输入评论内容">
        <input type="hidden" name="course_id" value="{{$course_id}}"/>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</body>
</html>
@endsection