       //share in weixin
      document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
        WeixinJSBridge.on('menu:share:appmessage', function(argv) {
          WeixinJSBridge.invoke('sendAppMessage', shareWX, function(res) {});
        });
        WeixinJSBridge.on('menu:share:timeline', function(argv) {
          WeixinJSBridge.invoke('shareTimeline', shareWXTL, function(res) {});
        });
      }, false);
      function share_Wx_Dp_Attach(args) {
         function is_weixin() {
          var ua = navigator.userAgent.toLowerCase();
          if (ua.match(/MicroMessenger/i) == "micromessenger") {
            return true;
          } else {
            return false;
          }
        }
        function showShareTips(info) {
          var tips = $('<p class="ajax-tips weixin-share-tips" style="z-index:999;"></p>').css({
            'font-size': '13px',
            'line-height': '180%',
            'position': 'fixed',
            'width': document.documentElement.scrollWidth,
            'height': document.documentElement.clientHeight,
            'margin': 0,
            'padding': '40px 10px',
            'color': ' #fff',
            'background-color': 'rgba(0,0,0,.8)',
            'top': 0,
            'left': 0,
            'background-image': 'url(http://si1.s1.dpfile.com/t/cssnew/events/labevent/seefilm/mmimages/share-cover-tips.e3893cb7ee521914fd768d05fab419b3.png)',
            'background-repeat': 'no-repeat',
            '-webkit-background-size': '100% auto',
            'background-size': '100% auto'
          }).appendTo($('body'));
          if (info) {
            tips.html(info);
          }
          tips.on('click', function() {
            tips.remove();
          });
          setTimeout(function() {
            tips.remove();
          }, 3000);
        }
        function isInDp(){
          var userAgent = window.navigator.userAgent.toLowerCase(),
          isInDp=!userAgent.match(/MicroMessenger/i)&&!userAgent.match("safari") && !userAgent.match("chrome");
          return isInDp;
        }
        if(is_weixin()){
          showShareTips();
          return;
        }
        if (typeof WeixinJSBridge != 'undefined') {
          showShareTips();
          return;
        };
        if (isInDp()) {
          args = (typeof args === 'object') ? JSON.stringify(args) : args + '';
          location.href = "js://_?method=share&args=" + encodeURIComponent(args);
        }
      }



