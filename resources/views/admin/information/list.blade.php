@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <h3 align="center">咨询模块</h3>
    <p align="center">浏览次数.{{$info_hot}}</p>
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>咨询id</th>
                <th>咨询标题</th>
                <th>咨询内容</th>
                <th>咨询时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="list">
            @foreach($date as $k=>$v)
            <tr>
                <td>{{ $v->info_id }}</td>
                <td>{{ $v->info_title }}</td>
                <td>
                    {{--显示前台富文本传过来的图片--}}
                    <?php
                        echo html_entity_decode($v->info_content, 1)
                    ?>
                </td>
                <td>{{date('Y-m-d H:i:s',$v->info_time)}}</td>
                <td>
                    <div class="layui-btn-group">
                        <a type="button" class="layui-btn" href="/admin/information/info_add">增加</a>
                        <a type="button" class="layui-btn" info_id="{{ $v->info_id }}" href="/admin/information/info_update?info_id={{ $v->info_id }}">编辑</a>
                        <a type="button" class="layui-btn" info_id="{{ $v->info_id }}" href="/admin/information/info_del?info_id={{ $v->info_id }}">删除</a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div align="center">
        	{{ $date ->appends([])->links() }}
        </div>

    </div>
@endsection
