/*=====creatBy mwq 2017/11/29 =====*/

/*
!function (window, document, $, undefined) {
    var $navList1 = $('.nav-list1'),
        $as = $navList1.find('a');
        $as.on('click', function() {
            var $this = $(this),
                item = $this.attr('href');
            $(item).css('padding-top', '65px');

        })

}(window, document, jQuery);*/

var showPageController = function (){
    var that = this;
    this.init=function () {
        that.regEvent();
    }
    this.regEvent = function(){
        that.headerTitleClick();
        that.checkInputClick();


    }
    /*首页跳转执行的方法*/
    this.headerTitleClick = function(){
        var $navList1 = $('.nav-list1'),
            $as = $navList1.find('a');
        $as.on('click', function() {
            var $this = $(this),
                item = $this.attr('href');
            $(item).css('padding-top', '48px');

        })
    }
    /* 提交按钮点击时执行的方法*/
    this.checkInputClick = function () {
        var $btn_submit = $("#btn_submit"),
            $user_name = $("#name"),
            $user_email = $("#email");

        $btn_submit.on('click',function () {
            //获取id对应的元素的值，去掉其左右的空格
            var $userVal = $.trim($("#name").val()),
                $emailVal = $.trim($("#email").val());

            //验证邮箱格式的js正则表达式
            var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            //清空显示层中的数据
            $("#emailMess").html("");
            if ($userVal == "") {
                $("#emailMess").html("<font color='red'>" + "姓名不能为空" + "</font>");
            }
            if ($emailVal == "") {
                $("#emailMess").html("<font color='red'>" + "邮箱不能为空" + "</font>");
            }
            else if (!(isEmail.test($emailVal))) {
                $("#emailMess").html("<font color='red'>" + "邮箱格式不正确" + "</font>");
            }
            else {
                //此处可以操作向后台发送json数据，然后返回验证结果
            }


        })

    }
}

$(function () {
    var qst = new showPageController();
    qst.init();
});