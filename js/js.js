$(function(){
	//二维码
	(function(){
		var img_src = $('.qr_img')[0].src;
		if(browserIsIe()){
			$('.down_qr').on('click',function(){
				img_src = $('.qr_img')[0].src;
				DownLoadReportIMG(img_src);
			});
		}else{
		
			$('.down_qr').attr('download',img_src);
			$('.down_qr').attr('href',img_src);

			$('.sutmit_btn').on('click',function(){
				$('.down_qr').attr('download',img_src);
				$('.down_qr').attr('href',img_src);
			});
		}
		
	})();
});

function DownLoadReportIMG(imgPathURL) {
    //如果隐藏IFRAME不存在，则添加
    if (!document.getElementById("IframeReportImg"))
        $('<iframe style="display:none;" id="IframeReportImg" name="IframeReportImg" onload="DoSaveAsIMG();" width="0" height="0" src="about:blank"></iframe>').appendTo("body");
    if (document.all.IframeReportImg.src != imgPathURL) {
        //加载图片
        document.all.IframeReportImg.src = imgPathURL;
    }
    else {
        //图片直接另存为
        DoSaveAsIMG();
    }
}
function DoSaveAsIMG() {
    if (document.all.IframeReportImg.src != "about:blank")
        window.frames["IframeReportImg"].document.execCommand("SaveAs");
}
//判断是否为ie浏览器
function browserIsIe() {
    if (!!window.ActiveXObject || "ActiveXObject" in window)
        return true;
    else
        return false;
}