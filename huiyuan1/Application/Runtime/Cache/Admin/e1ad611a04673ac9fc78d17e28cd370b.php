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
<div class="title"><h2>留言管理</h2></div>
 <form class="form-search" action="<?php echo U('index');?>" method="get">
            <select name="searchType">
                <option value="m_name">姓名</option>
                <option value="m_email">邮箱</option>
                <option value="m_message">留言内容</option>
            </select>
            <input name="search" value="<?php echo ($_GET['search']); ?>" type="text"/>
            <input class="btn btn-primary" type="submit" value="搜索"/>
        </form>
<div class="table-operate ue-clear">

    <div class="btngrou">
            <button class="btn" type="button">刷新</button>
            <button class="btn" type="button">一键导出</button>
            <button class="btn" type="button">发送邮箱</button>
            <button class="btn btn-warning" type="button">帮助</button>

        </div>
</div>
<div class="table-box">
    <table>
        <thead>
            <tr>
               <th>序号</th>
                    <th>留言时间</th>
                    <th>姓名</th>
                    <th>邮箱</th>
                    <th>留言内容</th>
            </tr>
        </thead>
        <tbody>
        <?php if(is_array($data)): foreach($data as $k=>$vo): ?><tr>
                    <td><?php echo ($k+1); ?></td>
                    <td><?php echo ($vo["m_time"]); ?></td>
                    <td><?php echo ($vo["m_name"]); ?></td>
                    <td><?php echo ($vo["m_email"]); ?></td>
                    <td><?php echo ($vo["m_message"]); ?></td>
                </tr><?php endforeach; endif; ?>
        </tbody>
    </table>
    <?php echo ($page); ?>
</div>
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