<!DOCTYPE html>
<html>
<head>
	<title>xxxx</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!--禁用手机号码链接(for iPhone)-->
	<meta name="format-detection" content="telephone=no">

	<!--自适应设备宽度-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimum-scale=1.0,maximum-scale=1.0,minimal-ui" />
	
	<!--控制全屏时顶部状态栏的外，默认白色-->
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!--是否启动webapp功能，会删除默认的苹果工具栏和菜单栏。-->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="Keywords" content="">
	<meta name="Description" content="...">

	<link rel='stylesheet' type='text/css' href="/assets/css/reset.css">
	<link rel='stylesheet' type='text/css' href="/assets/css/common.css">
	<link rel='stylesheet' type='text/css' href="/assets/css/main.css">
	<script>

	</script>
	<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/rem.js"></script>
	<script type="text/javascript" src="assets/js/common.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<script type="text/javascript" src="assets/js/share.js"></script>
	<script type="text/javascript">
	    var phoneWidth =  parseInt(window.screen.width);
	    var phoneScale = phoneWidth/640;
	    var ua = navigator.userAgent;
	    if (/Android (\d+\.\d+)/.test(ua)){
	        var version = parseFloat(RegExp.$1);
	        if(version>2.3){
	            document.write('<meta name="viewport" content="width=640, minimum-scale = '+phoneScale+', maximum-scale = '+phoneScale+', target-densitydpi=device-dpi">');
	        }else{
	            document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
	        }
	    } else {
	        document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
	    }
	</script>
</head>
<body>

<div class="wrapper">

</div>

<!-- 横屏代码 -->
<div id="orientLayer" class="mod-orient-layer">
    <div class="mod-orient-layer__content">
        <i class="icon mod-orient-layer__icon-orient"></i>
        <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览</div>
    </div>
</div>

<script>
<?php print $config; ?>

wx.ready(function(){
	wechatShare({
			title: 'xxxxxx',
			t_title: 'xxxxxxx',
			link: location.href,
			img: "http://" + window.location.host + "/assets/img/share.jpg",
			desc: 'xxxxxxx'
		}, function(env){
			//callback fun
		});

	// wx.hideMenuItems({
		//   		menuList: data.exclude // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
	// });

});

</script>
</body>
</html>
