@extends('layouts.admin')
@section('title', 'Page Title')
@section('content')

    <div>
        <h1 align="center">文章列表</h1>
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
                <th>文章标题</th>
                <th>文章名称</th>
                <th>文章简介</th>
                <th>文章视频</th>
                <th>是否免费</th>
                <th >操作</th>
            </tr>
            </thead>

            <tbody id="list" align="center">

            </tbody>

        </table>
    </div>
    <div id="demo0" align="center">
        <div class="layui-box layui-laypage layui-laypage-default" id="pages" >

        </div>
    </div>
    <!-- <ul id="pages" align="center" class="layui-elem-field layui-field-title" style="margin-top: 30px;">

    </ul> -->
    <script type="text/javascript">
            var course_id = getUrlParam('id');
            //alert(catelog_id);
        $.ajax({
            url:"{{url("admin/catelog/catalog_list")}}",
            data:{course_id:course_id},
            type:"GET",
            dataType:"json",
            success:function(res){
//                alert(111);return;
                // 拿到json进行页面拼接
                post(res);
            }
        })

        //分页
        $(document).on('click','#pages a',function(){
            var page = $(this).attr('page');
            var val = $("#ad").val();
            //alert(111);return;
            $.ajax({
                url:"{{url("admin/catelog/catalog_list")}}",
                data:{page:page,val:val,course_id:course_id},
                type:"GET",
                dataType:"json",
                success:function(res){
                    post(res);
                }
            })

        })





        $(document).on('click','.show',function(){
            //alert(111);
            var val = $("#ad").val();
            //console.log(name);
            $.ajax({
                url:"{{url("admin/catelog/catalog_list")}}",
                data:{val:val,course_id:course_id},
                type: 'GET',
                dataType: 'json',
                success:function(res){
                    //console.log(1111);
                    // 拿到json进行页面拼接
                    post(res);
                }

            })

        })

        function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return decodeURI(r[2]); return null; //返回参数值
        }
        function post(res){
            $("#list").empty();
            $.each(res.data,function(i,v){
                var tr = $("<tr></tr>"); //构建一个空对象
//                alert(111);return;

                // alert(111);

                tr.append("<td>"+v.catalog_head+"</td>");
                tr.append("<td>"+v.catelog_name+"</td>");
                tr.append("<td>"+v.catelog_describe+"</td>");
                tr.append("<td><video src='http://{{$img}}/"+v.cate_page+"' controls height='30%' width='30%'></video></td>");
                tr.append("<td>"+v.is_free+"</td>");

                tr.append("<td><a href='/admin/catelog/catelog_del?id="+v.catelog_id+"&course_id="+v.course_id+"' id='"+v.catelog_id+"'class='del layui-btn layui-btn-sm layui-btn-danger'>删除</a>&nbsp;<a href='/admin/catelog/catelog_upd?id="+v.catelog_id+"' id='"+v.catelog_id+"'class='del layui-btn layui-btn-sm layui-btn-danger'>修改</a>&nbsp;<a href='index' class='del layui-btn layui-btn-sm layui-btn-danger'>添加</a>&nbsp;<a href='/admin/job/job_add?id="+v.catelog_id+"&course_id="+v.course_id+"' id='"+v.catelog_id+"'class='layui-btn layui-btn-sm layui-btn-warm'>添加作业</a>&nbsp;<a href='/admin/job/job_list?id="+v.catelog_id+"&course_id="+v.course_id+"' id='"+v.catelog_id+"'class='layui-btn layui-btn-sm layui-btn-warm'>作业详情</a></td>");

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

