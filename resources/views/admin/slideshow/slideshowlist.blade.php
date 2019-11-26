@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')


                <div class="col-sm-11">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h1 align="center">轮播图展示</h1>

                    </div>
                    <div class="ibox-content">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>名称</th>
                                    <th>图片</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>

                               @foreach($data as $key=>$val)
                                <tr>
                                    <td>{{$val->s_id}} </td>
                                    <td>{{$val->s_name}} </td>
                                    <td><img src="/uploads/{{$val->s_img}}" width="100"></td>
                                    <td>{{date('Y-m-d',$val->created_at)}} </td>
                                    <td class="text-navy"> <a class="btn btn-danger btn-rounded" href="/admin/slideshow/del?s_id={{$val->s_id}}">删除</a></td>
                                    <td class="text-navy"> <a class="btn btn-danger btn-rounded" href="/admin/slideshow/exit?s_id={{$val->s_id}}">修改</a></td>
                                </tr>
                                 @endforeach
                            </tbody>
                        </table>
                         <center>{{$data->links()}}</center>
                    </div>
                </div>
            </div>


@endsection