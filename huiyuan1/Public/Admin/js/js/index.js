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
    this.headerTitleClick = function(){
        var $navList1 = $('.nav-list1'),
            $as = $navList1.find('a');
        $as.on('click', function() {
            var $this = $(this),
                item = $this.attr('href');
            $(item).css('padding-top', '65px');

        })
    }
    this.checkInputClick = function () {
        var $btn_submit = $("#btn_submit")
        var $user_name = $("#name");
        var $user_email = $("#email");
        var $userNull = $(".userNull")
        var $emailNull = $(".emailNull")
        $btn_submit.on("click",function(){
            if ($user_name.val() == "") {
                $userNull.css("dispalay","block")
            }
            if ($user_email.val() == "") {
                $emailNull.css("dispalay","block")

            }


        })


    }


}

$(function () {
    var qst = new showPageController();
    qst.init();
});