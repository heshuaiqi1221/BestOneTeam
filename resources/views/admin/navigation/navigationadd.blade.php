@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>后台导航添加<small></small></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="form_basic.html#">选项1</a>
                                </li>
                                <li><a href="form_basic.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" action="/admin/navigation/data">
                                    <div class="form-group">
                                        <label>导航名称</label>
                                        <input type="type" class="form-control" name="n_name">
                                    </div>
                                    <div class="form-group">
                                        <label>链接地址</label>
                                        <input type="type" class="form-control" name="n_url">
                                    </div>
                                    <div class="form-group">
                                        <label>排序</label>
                                        <input type="type" class="form-control" name="details">
                                    </div>
                                    <div class="form-group">
                                        <label>是否展示</label>
                                        <input type="radio" name="is_show" value="1">是
                                        <input type="radio" name="is_show" value="2">否
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>添 加</strong>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>

@endsection