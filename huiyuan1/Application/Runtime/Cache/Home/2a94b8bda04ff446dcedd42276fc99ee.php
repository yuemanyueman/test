<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="print">
    <meta name="Keywords" content="标题">
    <meta name="Description" content="描述">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no,minimal-ui">  <!-- 手机端 -->
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <!--[if lt IE 9]>-->
    <!--<script src="js/html5shiv.js" defer async="true"></script>-->
    <!--<![endif]-->
    <!--[if lt IE 10]>-->
    <!--<div style="position:relative;z-index:99;width:100%;height:50px;background:#ffffe9;color:#1e5494;border-bottom:1px solid #e6e6c6;text-align:center;line-height:50px;font-size:12px;">您使用的浏览器版本过低，浏览的网页可能不会达到最佳效果，建议您升级您的浏览器。</div>-->
    <!--<![endif]-->

</head>
<title></title>
<link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="/huiyuan1/Public/Home/js/jquery-1.9.1.js"></script>
<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#edits").on('click', function () {
        var text = $("input[name='num']:checked").map(function (index, elem) {
            return $(elem).val();
        }).get().join(',');
        if (text == '') {
            alert('请选择要修改的数据');
        } else {
            if (text.indexOf(',') != -1)//取字符串下标，不存在等于-1
            {
                alert('请选择单个数据修改');
            } else {
                window.location.href="/huiyuan1/Home/Index/edit/id/"+text;
            }
        }
    });
})    
</script>

<style type="text/css">
  table{
    padding：5px 5px;
  }
</style>
</head>
<body>

<div class="container" >
<div class="row">
<div style="margin-top:30px;">
<a href="<?php echo U('add');?>" id="Button1"  class="btn btn-success" type="button">添加</a>
<button type="button" class="btn btn-primary" data-toggle="modal"  id="edits">修改</button>
<form class="form-inline col-sm-6" action="<?php echo U('index');?>" method="get">
                <div class="">
                        <div class="form-group">
                            <label for="icefloeName" class="control-label">姓名</label>
                            <input type="text" id="icefloeName" class="form-control" name="name" value="<?php echo ($_GET['name']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="icefloeName" class="control-label">手机号</label>
                            <input type="text" id="icefloeName" class="form-control" name="phone" value="<?php echo ($_GET['phone']); ?>">
                        </div>
                        <button class="btn btn-danger">搜索</button>
                </div>
</form>
</div>
</div>


<div class="table-responsive">
    <table id="tab1"  class="imagetable table table-striped border ">
        <thead>
        <tr>
        <th><input id="sel" type="checkbox"></th>
           <th >
            序号
          </th>
          <th >
            姓名
          </th>
          <th>
            手机号     
         </th>
         <th>
            积分     
         </th>
         <th>
            总积分     
         </th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
              <td><input name="num" type="checkbox" value="<?php echo ($vo["id"]); ?>"></td>
              <td><?php echo ($vo["xuhao"]); ?></td>
              <td><?php echo ($vo["name"]); ?></td>
              <td><?php echo ($vo["phone"]); ?></td>
              <td><?php echo ($vo["integral"]); ?></td>
              <td><?php echo ($vo["t_integral"]); ?></td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<div class="content_main container-fluid"><?php echo ($page); ?>
</div>

</div>
  
</body>
</html>