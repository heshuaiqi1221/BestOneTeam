@extends('layouts.admin')

@section('content')
    @parent

    <div>
        <h1 align="center">讲师列表</h1>
        <div style="margin-bottom: 20px;"></div>
        <div align="center">
            <input type="text" name="name_box" id="ad" class="layui-form-item" />
            <input type="button" class="show layui-btn layui-btn-warm" value="搜索" />
        </div>
        <table class="layui-table" align="center">
            <!-- <colgroup align="center">
              <col width="150" >
              <col width="200" >
              <col>
            </colgroup> -->
            <thead >
            <tr align="center">
                <th>编号</th>
                <th>讲师头像</th>
                <th>姓名</th>
                <th>个人简历</th>
                <th>授课风格</th>
                <th >操作</th>
            </tr>
            </thead>

            <tbody id="list" align="center">

            </tbody>

        </table>
    </div>
    <div id="demo0" align="center">
        <div class="layui-box layui-laypage layui-laypage-default" id="pages" >
            <!-- <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a>
            <a href="javascript:;" data-page="2">1</a>
            <a href="javascript:;" data-page="2">2</a>
            <a href="javascript:;" data-page="3">3</a>
            <a href="javascript:;" data-page="4">4</a>
            <a href="javascript:;" data-page="5">5</a>
            <a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a> -->
        </div>
    </div>
    <!-- <ul id="pages" align="center" class="layui-elem-field layui-field-title" style="margin-top: 30px;">

    </ul> -->
    <script type="text/javascript">


         var url ="{{url('admin/lect/index_list')}}";
        $.ajax({
            url:url,
            type:"GET",
            dataType:"json",
            success:function(res){
                 post(res);
            }
        })

        //分页
        $(document).on('click','#pages a',function(){
            var page = $(this).attr('page');
            var val = $("#ad").val();

            $.ajax({
                url:url,
                data:{page:page,val:val},
                type:"GET",
                dataType:"json",
                success:function(res){
                    post(res);
                }
            })

        })


        // 删除
        $(document).on('click','.del',function(){
            //alert(111);
            var id = $(this).attr('id');
            console.log(id);
            $.ajax({
                url:"{{url('admin/lect/destroy')}}",
                data:{id:id},
                dataType:"json",
                success:function(res){
                    alert(res.msg);
                    location.href="{{url('admin/lect/list')}}";
                }
            })


        })


        //修改
        $(document).on('click','.btn',function(){
            var id = $(this).attr('id');
            location.href="/admin/lect/edit?id="+id;
        });


        $(document).on('click','.show',function(){

            var val = $("#ad").val();
            $.ajax({
                url:url,
                data:{val:val},
                type: 'GET',
                dataType: 'json',
                success:function(res){
                    //console.log(1111);
                    // 拿到json进行页面拼接
                    post(res);
                }

            })

        })


        function post(res){
            $("#list").empty();
            $.each(res.data,function(i,v){
                var tr = $("<tr></tr>"); //构建一个空对象
                // alert(111);return;

                // alert(111);
                tr.append("<td>"+v.lect_id+"</td>");
                tr.append("<td>"+"<img src='/uploads/"+v.lect_image+"' width='100' height='100'>"+"</td>");
                tr.append("<td>"+v.lect_name+"</td>");
                tr.append("<td>"+v.lect_resume+"</td>");
                tr.append("<td>"+v.lect_style+"</td>");
                tr.append("<td><a href='javascript:;' id='"+v.lect_id+"'class='del layui-btn layui-btn-sm layui-btn-danger'>删除</a>&nbsp;<a href='javascript:;' id='"+v.lect_id+"' class='btn layui-btn layui-btn-sm'>编辑</a>&nbsp;<a href='/admin/lect/create' class='layui-btn layui-btn-sm'>添加</a> <a href='/admin/course_list?lect_id="+v.lect_id+"'  class='layui-btn layui-btn-sm'>查看课程</a>" +"<a href='/admin/course_add?lect_id=" +v.lect_id+"'  class='layui-btn layui-btn-sm'>添加课程</a></td>");

                $("#list").append(tr);
            })
            var page = "";
            for (var i=1; i<=res.last_page; i++) {
                page += "<a page='"+i+"'>第"+i+"页</a>";
            }
            $('#pages').html(page);
        }



    </script>

@endsection

