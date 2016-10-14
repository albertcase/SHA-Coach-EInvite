//默认第一个显示focus
    //$(document).ready(function() {
        //$("#sn1").focus();
        //自动跳到下一个输入框
        $(".telArea li input[name^='sn']").each(function() {
            $(this).keyup(function(e) {
                e = window.event || e;
                var k = e.keyCode || e.which;
                if (k == 8) {   //8是空格键
                    if ($(this).val().length < 1) {
                        $(this).prev().focus();
                        $(this).prev().focus(function() {
                            var obj = e.srcElement ? e.srcElement: e.target;
                            if (obj.createTextRange) { //IE浏览器
                                var range = obj.createTextRange();
                                range.moveStart("character", 4);
                                range.collapse(true);
                                range.select();
                            }
                        });
                    }
                } else {
                    if ($(this).val().length > 3) {
                        $(this).next().focus();
                    }
                }
            })
        });

        $("input[type='text'][id^='sn']").bind('keyup',
                function() {
                    var len = $("#sn1").val().length + $("#sn2").val().length + $("#sn3").val().length + $("#sn4").val().length;
                    if (len == 16) device_verify();
                });
    //});