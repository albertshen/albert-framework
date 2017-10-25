function wechatShare(data, callback) {
	wx.onMenuShareTimeline({
	    title: data.t_title, // 分享标题
	    link: data.link, // 分享链接
	    imgUrl: data.img, // 分享图标
	    success: function () {
	        // 用户确认分享后执行的回调函数
	        callback('Timeline');
	        //_hmt.push(['_trackEvent', 'wechat', 'share', 'Timeline']);
	    },
	    cancel: function () { 
	        // 用户取消分享后执行的回调函数
	        // alert("分享失败")
	    }
	});

	wx.onMenuShareAppMessage({
	    title: data.title, // 分享标题
	    link: data.link, // 分享链接
	    imgUrl: data.img, // 分享图标
	  	desc: data.desc,
	    success: function () { 
	        // 用户确认分享后执行的回调函数
	        callback('AppMessage');
	        //_hmt.push(['_trackEvent', 'wechat', 'share', 'AppMessage']);
	    },
	    cancel: function () { 
	        // 用户取消分享后执行的回调函数
	       // alert("分享失败")
	    }
	});
}
