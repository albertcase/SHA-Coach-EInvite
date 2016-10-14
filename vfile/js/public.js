var shareArr = {
    "_title": 'maxmara 分享标题 -- 测试', //分享标题
    "_desc": "maxmara 分享朋友圈的描述 -- 测试",    // 分享朋友圈的描述
    "_desc_friend": "maxmara 分享好友的描述 -- 测试",    // 分享好友的描述
    "_link": window.location.href,    //分享的连接
    "_imgUrl": "http://" + window.location.host + "/vstyle/fasttrack/img/share.jpg",   //分享的图片
    "_url": encodeURIComponent(window.location)//encodeURIComponent(window.location.href.split("#")[0]) //.replace('http%3A%2F%2F','')
}

var pfun = {
    init: function(){
        var self = this;
        self.ajaxFun("GET", "http://maxmara.samesamechina.com/sharetoken?url=" + shareArr["_url"], "", "jsonp", function(data){
            self.wechatFun(data.jssdk.appid, data.jssdk.time, data.jssdk.noncestr, data.jssdk.sign);
        });
    },
    loadFn: function(arr , fn , fn2){
        var loader = new PxLoader();
            for( var i = 0 ; i < arr.length; i ++)
            {
                loader.addImage(arr[i]);
            };
            
            loader.addProgressListener(function(e) {
                    var percent = Math.round( e.completedCount / e.totalCount * 100 );
                    if(fn2) fn2(percent)
            }); 
            
            
            loader.addCompletionListener( function(){
                if(fn) fn();    
            });
            loader.start(); 
    },
    formErrorTips: function(alertNodeContext){  //错误提示弹层
        var alertInt;
        clearTimeout(alertInt);
        if($(".alertNode").length > 0){
            $(".alertNode").html(alertNodeContext);
        }else{
            var alertNode = document.createElement("div");
                alertNode.setAttribute("class","alertNode");
                alertNode.innerHTML = alertNodeContext;
                document.body.appendChild(alertNode);

        }
        alertInt = setTimeout(function(){
            $(".alertNode").remove();
        },3000);
    },
    wechatFun: function(_appId, _timestamp, _nonceStr, _signature){  //分享函数
        wx.config({
            debug: false,
            appId: _appId,
            timestamp: _timestamp,
            nonceStr: _nonceStr,
            signature: _signature,
            jsApiList: [
                // 所有要调用的 API 都要加到这个列表中
                'checkJsApi',
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'hideMenuItems',
                'showMenuItems',
                'hideAllNonBaseMenuItem',
                'showAllNonBaseMenuItem',
                'getNetworkType',
                'openLocation',
                'getLocation',
                'hideOptionMenu',
                'showOptionMenu',
                'closeWindow'
            ]
        });

        this.wxshareFun();
    },
    wxshareFun: function(){  //分享信息重置函数
        wx.ready(function () {
            // 在这里调用 API
            // 2. 分享接口
            // 2.1 监听“分享给朋友”，按钮点击、自定义分享内容及分享结果接口

            wx.onMenuShareAppMessage({
                title: " ",
                desc: shareArr._desc_friend,
                link: shareArr._link,
                imgUrl: shareArr._imgUrl,
                trigger: function (res) {
                    //  alert('用户点击发送给朋友');
                },
                success: function (res) {
                    //_hmt.push(['_trackEvent', 'share', 'ShareAppMessage']);
                    //  alert('已分享');
                },
                cancel: function (res) {
                    //  alert('已取消');
                },
                fail: function (res) {
                    //  alert(JSON.stringify(res));
                }
            });


            // 2.2 监听“分享到朋友圈”按钮点击、自定义分享内容及分享结果接口

            wx.onMenuShareTimeline({
                title: shareArr._desc,
                link: shareArr._link,
                imgUrl: shareArr._imgUrl,
                trigger: function (res) {
                    //_hmt.push(['_trackEvent', 'share', 'ShareTimeline']);
                    //   alert('用户点击分享到朋友圈');
                },
                success: function (res) {

                    // alert('已分享');
                },
                cancel: function (res) {
                    //  alert('已取消');
                },
                fail: function (res) {
                    //   alert(JSON.stringify(res));
                }
            });
        }); //end of wx.ready
    },
    ajaxFun: function(ajaxType, ajaxUrl, ajaxData, ajaxDataType, ajaxCallback){
       $.ajax({
            type: ajaxType,
            url: ajaxUrl,
            data: ajaxData,
            dataType: ajaxDataType
        }).done(function(data){
            ajaxCallback(data)
        })
        
        // ajaxfun("GET", "/weixin/jssdk", jssdkPushData, "json", jssdkCallback);

        // function jssdkCallback(data){
        //     wechatShare(data.appid, data.time, data.noncestr, data.sign);
        // }  
    },
    loadingFnDoing: function(allAmg, loadCallback){
        pfun.loadFn(allAmg , function (){

            $("img").each(function(){ 
                $(this).attr("src",$(this).attr("sourcesrc"));
            })
            
            loadCallback();
            
        } , function (p){
            $(".loading em").html(p);
            //console.log(p);
        });
    }

}


pfun.init();



