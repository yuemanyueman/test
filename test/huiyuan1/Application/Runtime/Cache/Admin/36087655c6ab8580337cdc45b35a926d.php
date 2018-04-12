<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="/lengyun/Public/Admin/css/base.css" />
<link rel="stylesheet" href="/lengyun/Public/Admin/css/info-mgt.css" />
<link rel="stylesheet" href="/lengyun/Public/Admin/css/WdatePicker.css" />
<title>移动办公自动化系统</title>
<style type='text/css'>
	table tr .num {width:50px;}
	table tr .name {width:320px;}
	table tr .process {width:80px;}
	table tr .file {width:80px; padding-left:13px;}
	table tr .node {width:80px;}
	table tr .addtime {width:80px;}
	.i-content {height:400px; overflow:auto;}
</style>
</head>

<body>
<div class="title"><h2>资讯管理</h2></div>
<div class="table-operate ue-clear">
	<a href="<?php echo U('add');?>" class="add">添加</a>
    <a href="javascript:;" class="del" id='btnDel'>删除</a>
    <a href="javascript:;" class="edit" id='btnEdit'>编辑</a>
</div>
<div class="table-box">
	<table>
    	<thead>
        	<tr>
            	<th class="num">序号</th>
				<th class="name">资讯名称</th>
                <th class="time">资讯描述</th>
                <th class="time">资讯链接</th>
                <th class="name">添加时间</th>
                <th class="name">上线时间</th>
                <th class="operate">状态</th>
                <th class="operate">操作</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
            	<td class="num"><?php echo ($k+1); ?></td>
                <td class="name"><?php echo ($vo["n_name"]); ?></td>
				<td class="descript">
					<a href='' class="content" data="<?php echo ($vo["n_descript"]); ?>">查看全文</a>
				</td>
                <td class="link"><?php echo ($vo["n_link"]); ?></td>
                <td class="addtime"><?php echo ($vo["n_addtime"]); ?></td>
                <td class="oltime"><?php echo ($vo["n_oltime"]); ?></td>                
            	<td >
            	<?php if($vo["n_status"] == 1): ?>已上线
            	<?php elseif($vo["n_status"] == 2): ?>待上线
            	<?php else: ?>已下线<?php endif; ?>
				</td>
                <td class="operate">
                	<a href="<?php echo U('edit', 'id='.$vo['n_id']);?>">编辑</a>
                	<a href="<?php echo U('del', 'id='.$vo['n_id']);?>" onclick="return del()">删除</a>
                </td>
            </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
</div>
<?php echo ($page); ?>
</body>
<script type="text/javascript" src="/lengyun/Public/Admin/js/jquery.js"></script>
<script type="text/javascript" src="/lengyun/Public/Admin/js/common.js"></script>
<script type="text/javascript" src="/lengyun/Public/Admin/js/core.js"></script>
<script type="text/javascript" src="/lengyun/Public/Admin/js/WdatePicker.js"></script>
<script type="text/javascript" src="/lengyun/Public/Admin/js/jquery.pagination.js"></script>
<script type="text/javascript">

function del(){
		return confirm('您确定删除该公文吗?');
	}
//定义页面载入事件
$(function(){

	//获取btnShow按钮并绑定相关事件
	$('.show').bind('click',function(){
		var id = $(this).parent().siblings('td').eq(0).text();
		var title = $(this).parent().siblings('td').eq(1).text();
		//通过Ajax从服务器端获取数据
		var data = {
			id:id,
			_:new Date().getTime()
		};
		$.get('/thinkoa/index.php/Admin/Doc/getContent',data,function(msg){
			iDialog({
			    title:title,
			    id:'DemoDialog'+id,
			    content:msg,
			    lock: true,
			    width:800,
			    fixed: true
			});
		});
	});
	
	//获取btnEdit按钮并绑定相关事件
	$('#btnEdit').bind('click',function(){
		//获取选中的id元素
		var id = $(':checkbox:checked').val();
		//判断id是否为空
		if(id == undefined) {
			alert('请选择您要编辑的元素');
			return;
		}
		//跳转到当前控制器的edit方法
		location.href = '/thinkoa/index.php/Admin/Doc/edit/id/'+id;
	});
	
	//获取btnDel按钮并绑定相关事件
	$('#btnDel').bind('click',function(){
		if(confirm('确定删除？真的想好了么？')) {
			//获取选中的id元素
			var id = $(':checkbox:checked');
			var ids = '';
			for(var i=0;i<id.length;i++) {
				ids += id[i].value + ',';
			}
			if(ids == '') {
				alert('请选择您要删除的元素');
				return;
			}
			//ids = 1,2,3
			//去除最后一个逗号
			ids = ids.substring(0,ids.length-1);
			//跳转到删除方法del
			location.href = '/thinkoa/index.php/Admin/Doc/del/id/'+ids;
		}
	});
	
	//获取btnChart按钮并绑定相关事件
	$('#btnChart').bind('click',function(){
		//跳转到指定页面
		location.href = '/thinkoa/index.php/Admin/Doc/chart';
	});
});	
	
$(".select-title").on("click",function(){
	$(".select-list").hide();
	$(this).siblings($(".select-list")).show();
	return false;
})
$(".select-list").on("click","li",function(){
	var txt = $(this).text();
	$(this).parent($(".select-list")).siblings($(".select-title")).find("span").text(txt);
})

$('.pagination').pagination(100,{
	callback: function(page){
		alert(page);	
	},
	display_msg: true,
	setPageNo: true
});

$(".content").click(function(){
alert($(this).attr("data"));
});

$("tbody").find("tr:odd").css("backgroundColor","#eff6fa");

showRemind('input[type=text], textarea','placeholder');
</script>
</html>