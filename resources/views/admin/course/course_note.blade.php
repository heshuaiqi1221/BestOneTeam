@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')
    <form action="">
        <div>
            <h1 align="center">课程笔记列表</h1>
            <div style="margin-bottom: 20px;"></div>
            <table class="layui-table" align="center">
                <thead >
                <tr align="center">
                    <th>编号</th>
                    <th>课程名称</th>
                    <th>笔记内容</th>
                </tr>
                </thead>
                @foreach ($data as $k=>$v)
                    <tbody id="list" align="center">

                    <td>{{$v->course_id}}</td>
                    <td>{{$v->course_name}}</td>
                    <td>{{$v->note_desc}}</td>
                    </tbody>
                @endforeach
            </table>
        </div>
    </form>
    {{ $data ->appends([])->links() }}

@endsection

