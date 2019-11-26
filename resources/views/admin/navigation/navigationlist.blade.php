@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>后台导航列表页</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="table_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_basic.html#">选项1</a>
                            </li>
                            <li><a href="table_basic.html#">选项2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>导航id</th>
                            <th>导航名称</th>
                            <th>是否展示</th>
                            <th>链接地址</th>
                            <th>排序</th>
                            <th>添加日期</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $k=>$v)
                            <tr>
                                <td>{{$v->n_id}}</td>
                                <td>{{$v->n_name}}</td>
                                <td>
                                    @if($v->is_show == 1)
                                        √
                                    @else
                                        ×
                                    @endif
                                </td>
                                <td><a href="{{$v->n_url}}">{{$v->n_url}}</a></td>
                                <td>{{$v->details}}</td>
                                <td>{{date("Y-m-d H:i:s",$v->n_time)}}</td>
                                <td><a href="/admin/navigation/exit?n_id={{$v->n_id}}">[ 修改 ]</a> || <a href="/admin/navigation/del?n_id={{$v->n_id}}">[ 删除 ]</a></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    <div class="btn-group">
                        <button class="btn btn-white">{{ $data->links() }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script>
        //是否上架即点即改
        $(document).on("click",".se",function () {
            // alert(111);
            var _this = $(this);
            var id = _this.parents('tr').attr('id');
            // console.log(id);
            var test =_this.html();
            // console.log(test);
            var is_show = '';
            if (test=='√') {
                var test =_this.html('×');
                var is_show = 2;
            }else{
                var test =_this.html('√');
                var is_show = 1;
            }
            $.ajax({
                url:"/index/isshow",
                data:{is_show:is_show,id:id},
                type:'get',
                dataType:'json',
                success:function(res){
                    console.log(res);

                }
            })

        })
        //商品名称即点即改

        function saveuser(id){
            document.getElementById('aaa'+id).style.display='block';//显示input
            document.getElementById('bbb'+id).innerHTML="";//span标签的值设置为空
        }
        function edituser(id){
            var username = document.getElementById('aaa'+id).value;//获取文本框的值
            $.ajax({
                type:'GET',//请求方式
                data:{'id':id,'username':username},//传递参数
                url:"/index/shop",//地址
                success:function(e){//回调
                    console.log(e);
                    if(e==1){
                        document.getElementById('aaa'+id).style.display = 'none';//如果修改成功,input隐藏
                        document.getElementById('bbb'+id).innerHTML = username;//修改成功,将表里修改后的数据赋值给span标签
                    }else{
                        alert('修改失败');
                        window.location.reload();
                    }
                }

            })
        }

    </script>

@endsection
