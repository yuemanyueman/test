<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <link href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="/huiyuan1/Public/Home/js/jquery-1.9.1.js"></script>
  <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    ul li{
      list-style: none;
    }
  </style>
  <script type="text/javascript">

    $(function(){
      var aa=0;
      $('body').on('click', ".Add", function (){ 
        aa++;          
        $(this).parent().find('.adfs').after(
          '<li><label style="margin: 20px 20px;">积分:</label><input type="text" name="integral'+aa+'" value=""><input class="btn btn-primary del" type="button" style="margin-left:20px;" value="删除积分" /></li>\n'
          ); 
      });

      $('body').on('click', ".del", function () {
        $(".adfs").next().remove();
        });
    })
    
    function urlSubmit(){
      $('form').submit();
    }
  </script>

  <style type="text/css">
  </style>
</head>
<body>
  <div class="">
    <a  style="margin: 20px 20px;" class="btn btn-success" type="button" href="javascript:history.go(-1)"/>返回</a>
    <input id="Button1"  class="btn btn-danger Add" type="button"  value="添加积分" />
    <form action="" method="post">
      <div class="main">
        <ul>
          <li>
            <label style="margin: 20px 20px;">姓名：</label>
            <input type="text" name="name"/>
          </li>
          <li class="adfs">
              <label style="margin: 10px 10px;">手机号：</label>
              <input type="text" name="phone" id="phone" />
          </li>
        </ul>
          </div>
          <a href="javascript:void(0)" onclick="urlSubmit(this)" class="btn btn-info" style="margin: 10px 10px;">提交</a>
        </form>
      </div>  
    </body>
    </html>