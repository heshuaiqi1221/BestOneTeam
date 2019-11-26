@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <h2 align="center">轮播图修改页</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" class="form-x" action="/admin/slideshow/exitdo" enctype="multipart/form-data">
        @csrf
        <h2>轮播图名称：</h2>
        <div class="field">
            <input type="text" class="input w50" name="s_name" data-validate="required:请输入轮播图名称" value="{{$data[0]['s_name']}}"/>
            <input type="hidden" name="s_id" value="{{{$data[0]['s_id']}}}"/>
            <div class="tips"></div>
        </div>
        <h2>轮播图权重：</h2>
        <div class="field">
            <input type="text" class="input w50" name="s_weight" data-validate="required:请输入轮播图名称" value="{{$data[0]['s_weight']}}"/>
            <div class="tips"></div>
        </div>
        <h2>轮播图添加:</h2>
        <div class="field">
            <input type="file"  name="s_img" class="button bg-blue margin-left" id="image1" value="+ 浏览上传" style="float:left;">
        </div>
        <div class="form-group draggable">
            <div class="col-sm-10 col-sm-offset-3">
                <button class="btn btn-success " type="submit">
                    <i class="fa fa-upload"></i>
                    <span class="bold">上传</span>
            </div>
        </div>
    </form>
@endsection