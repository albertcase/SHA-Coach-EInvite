   //默认第一个显示focus
    $(document).ready(function() {
        //$("#sn1").focus();
        //自动跳到下一个输入框
        $(".telArea li").each(function() {
            var p = $(this).find("input");
            var _prev = $(this).prev().find("input");
            var _next = $(this).next().find("input");
            p.keyup(function(e) {
                e = window.event || e;
                var k = e.keyCode || e.which;
                if (k == 8) {   //8是空格键
                    if (p.val().length < 1) {
                        _prev.focus();
                        _prev.focus(function() {
                            var obj = e.srcElement ? e.srcElement: e.target;
                            if (obj.createTextRange) { //IE浏览器
                                var range = obj.createTextRange();
                                range.moveStart("character", 1);
                                range.collapse(true);
                                range.select();
                            }
                        });
                    }
                } else {
                    if (p.val().length > 0) {
                        _next.focus();
                    }
                }
            })
        });

    });