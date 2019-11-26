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
<h2><b>问答添加</b></h2>

<form action="" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">问答名称</label>
        <input type="text" id="name" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
    </div>

    <button class="btn btn-default">提交</button>
</form>
</body>
</html>
<script type="text/javascript">
    layui.use(['form', 'layedit', 'laydate'], function(){

    });
</script>
<script>



       $(document).on('blur','#name',function(){
          var name=$("[name=title]").val();
        $.ajax({
            url:"{{asset('admin/question_nameOnly')}}",
            data:{name:name},
            dataType:"json",
            success:function(res){
            	console.log(res);
            	  layer.msg(res.content,{icon:res.icon,time:2000},function(){
            	  	    if(res.content == '题库已存在该问题'){
                              $('.btn').prop('disabled','true')
            	  	    }
            	  })

            	  }
          })
      })



       //问题添加
    $(document).on('click','.btn',function(){
      var name=$("[name=title]").val();
       //alert(name);
      console.log(name);
            $.ajax({
            url:"{{asset('admin/question_doadd')}}",
            data:{name:name},
            dataType:"json",
            success:function(data){
            	  layer.msg(data.content,{icon:data.icon,time:2000});
                location.href="{{url('admin/question_list')}}";


            }
          })
      })

  //});

//});

</script>
@endsection