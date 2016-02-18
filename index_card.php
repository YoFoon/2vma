<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="Pragma" content="no-cache">
<meta name="robots" content="nofollow,noindex,noarchive">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="generator" content="二维码">
<meta name="author" content="YoFoon">
<meta name="description" content="二维码">
<meta name="keywords" content="YoFoon,二维码">
<link rel="Shortcut Icon" href="img/icon.ico" type="image/ico">
<title>名片码</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<script type="text/javascript" src='js/jquery.js'></script>
<script type="text/javascript" src='js/js_mingpian.js'></script>
</head>
<body>
    <?php
    echo "<div class='all col_333'>";
    echo "<div class='com clearfix'>";
    echo "<h1 class='heae_title fl'>名片码生成工具</h1>";
    echo "<div class='links fr'>";

        echo "<a class='gitght' target='_blank' title='github' href='https://github.com/YoFoon'></a>";
        echo "<a class='weibo' target='_blank' title='weibo' href='http://weibo.com/2048202647/profile?rightmod=1&wvr=6&mod=personinfo'></a>";
        echo "<a class='blog' target='_blank' title='blog' href='http://blog.yofoon.com/'></a>";

    echo "</div>";

    echo "</div>";
    echo "</div>";
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'H';
    if (isset($_POST['level']) && in_array($_POST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_POST['level'];    

    $matrixPointSize = 5;
    if (isset($_POST['size']))
        $matrixPointSize = min(max((int)$_POST['size'], 1), 10);


    if (isset($_POST['data'])) { 
        //it's very important!
        if (trim($_POST['data']) == '')
            die('<div class="com null_con">内容不能为空! <a href="?">返回</a></div>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_POST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_POST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('草料二维码http://cli.im', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
    echo "<div class='com mt_50 clearfix'>";
    echo "<div class='fl'>";
    //display generated file//
    echo '<img class="qr_img mp_img" src="'.$PNG_WEB_DIR.basename($filename).'" />';  
    
    echo "</div>";
    //config form
    echo "<div class='fl ml_30 right_area'>";
    echo '<form action="index_card.php" method="post" onsubmit="return check_input()">
        <label class="mp_label">姓&nbsp;&nbsp;名:</label>
        <input class="ipt" type="text" name="name" id="name" value="'.(isset($_POST['name'])?htmlspecialchars($_POST['name']):'').'" size="20" />&nbsp;<br/>
        
        <label class="mp_label">职&nbsp;&nbsp;务:</label>
        <input class="ipt" type="text" name="zhiwu" id="zhiwu" value="'.(isset($_POST['zhiwu'])?htmlspecialchars($_POST['zhiwu']):'').'" size="20" />&nbsp;<br/>
        
        <label class="mp_label">公&nbsp;&nbsp;司:</label>
        <input class="ipt" type="text" name="corp" id="corp" value="'.(isset($_POST['corp'])?htmlspecialchars($_POST['corp']):'').'" size="30" />&nbsp;<br/>      
        
        <label class="mp_label">私人电话:</label>
        <input class="ipt" type="text" name="mobile" id="mobile" value="'.(isset($_POST['mobile'])?htmlspecialchars($_POST['mobile']):'').'" size="20" />&nbsp;<br/>
        
        <label class="mp_label">工作电话:</label>
        <input class="ipt" type="text" name="tel" id="tel" value="'.(isset($_POST['tel'])?htmlspecialchars($_POST['tel']):'').'" size="20" />&nbsp;<br/> 
        
        <label class="mp_label">Q&nbsp;&nbsp;&nbsp;Q:</label>
        <input class="ipt" type="text" name="qq" id="qq" value="'.(isset($_POST['qq'])?htmlspecialchars($_POST['qq']):'').'" size="20" />&nbsp;<br/>
        
        <label class="mp_label">邮&nbsp;&nbsp;箱:</label>
        <input class="ipt" type="text" name="email" id="email" value="'.(isset($_POST['email'])?htmlspecialchars($_POST['email']):'').'" size="30" />&nbsp;<br/> 
        
        <label class="mp_label">个人网址:</label>
        <input class="ipt" type="text" name="url" id="url" value="'.(isset($_POST['url'])?htmlspecialchars($_POST['url']):'').'" size="30" />&nbsp;<br/> 
        
        <label class="mp_label">公司地址:</label>
        <input class="ipt" type="text" name="address" id="address" value="'.(isset($_POST['address'])?htmlspecialchars($_POST['address']):'').'" size="30" />&nbsp;<br/>                        
        
        <input name="data" id="data" value="'.(isset($_POST['data'])?htmlspecialchars($_POST['data']):'').'" type="hidden" />                
        
        <label class="label_style">图像质量:</label><select name="level" class="mp_level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'selected').'>H - best</option>
        </select>&nbsp;';
    // echo '<label class="label_style">图像的大小:</label><select name="size" class="mp_size">';
        
    // for($i=1;$i<=10;$i++)
    //     echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>&nbsp;<br/><br/>
        <input type="submit" value="生成名片码" class="btn mp_submit">';

    echo "<a class='btn mp_qr_dowm' href='' download=''>下载名片码</a>";

    echo "<a class='btn qr_jump' href='index.php'>二维码生成</a>";

    echo '</form>';
    echo "</div>";
    echo "</div>";
    echo "<div class='footer all'>
        <div class='com'>
            <p>© 2015-2015, Content By YoFoon. All Rights Reserved.</p>
            <p>Theme By YoFoon</p>
        </div>
    </div>";
    // benchmark
    //QRtools::timeBenchmark();  
    ?>
  </body></html>  

    