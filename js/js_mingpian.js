$(function(){
	(function(){
		var img_src = $('.mp_img')[0].src;
		if(browserIsIe()){
			$('.mp_qr_dowm').on('click',function(){
				img_src = $('.mp_img')[0].src;
				DownLoadReportIMG(img_src);
			});
		}else{
		
			$('.mp_qr_dowm').attr('download',img_src);
			$('.mp_qr_dowm').attr('href',img_src);

			$('.mp_submit').on('click',function(){
				$('.mp_qr_dowm').attr('download',img_src);
				$('.mp_qr_dowm').attr('href',img_src);
			});
		}
		
	})();
});

function check_input(){
	var name = $('#name').val();
	var zhiwu = $('#zhiwu').val();
	var corp = $('#corp').val();
	var tel = $('#tel').val();
	var mobile = $('#mobile').val();
	var fax = '';
	var qq = $('#qq').val();
	var email = $('#email').val();
	var url = $('#url').val();
	var address = $('#address').val();
	var	txt="BEGIN:VCARD\r\nVERSION:3.0\r\nFN:"+name+"\r\nORG:"+corp+"\r\nTITLE:"+zhiwu+"\r\nTEL;TYPE=CELL,VOICE:"+mobile+"\r\nTEL;TYPE=WORK,VOICE:"+tel+"\r\nTEL;WORK;FAX:"+fax+"\r\nX-QQ:"+qq+"\r\nEMAIL;TYPE=PREF,INTERNET:"+email+"\r\nURL:"+url+"\r\nADR;WORK:"+address+"\r\nREV:20100426T103000Z\r\nEND:VCARD";
	
	$('#data').val(txt);
	return true;
}

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