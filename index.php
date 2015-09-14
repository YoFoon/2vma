<?php    
/*
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */
    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="generator" content="二维码">
<meta name="author" content="YoFoon">
<meta name="description" content="二维码">
<meta name="keywords" content="YoFoon,二维码">
<link rel="Shortcut Icon" href="img/icon.ico" type="image/ico">
<title>二维码</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<script type="text/javascript" src='js/jquery.js'></script>
<script type="text/javascript" src='js/js.js'></script>
</head>
<body>
    <?php
    echo "<div class='all col_333'>";
    echo "<div class='com clearfix'>";
    echo "<h1 class='heae_title fl'>二维码生成工具</h1>";
    echo "<div class='links fr'>";

        echo "<a class='gitght' target='_blank' title='github' href='https://github.com/YoFoon'></a>";
        echo "<a class='weibo' target='_blank' title='weibo' href='http://weibo.com/2048202647/profile?rightmod=1&wvr=6&mod=personinfo'></a>";
        echo "<a class='blog' target='_blank' title='blog' href='http://yofoon.github.io/blog/'></a>";

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
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 6;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


    if (isset($_REQUEST['data'])) { 
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('<div class="com null_con">内容不能为空! <a href="?">返回</a></div>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('草料二维码http://cli.im', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }    
    echo "<div class='com mt_50 clearfix'>";
    echo "<div class='fl'>";
    //display generated file//<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'').'" size="50" />
    echo '<img class="qr_img" src="'.$PNG_WEB_DIR.basename($filename).'" />';  
    echo "</div>";
    //config form
    echo "<div class='fr ml_30 right_area'>";
    echo '<form action="index.php" method="post">
        
        <textarea name="data" id="data" placeholder="请输入文字内容，支持普通文本和网址！">'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'').'</textarea>
        <br />
        <label class="label_style">图像质量：</label>
        <select class="level" name="level">
            <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
            <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
            <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
            <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'selected').'>H - best</option>
        </select>&nbsp;';
    // echo '<label class="label_style">图像的大小:</label><select name="size" class="mp_size">';
        
    // for($i=1;$i<=10;$i++)
    //     echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    echo '</select>
        <input type="submit" class="sutmit_btn btn" value="生成二维码">';

    echo "<a class='down_qr btn' href='' download=''>下载二维码</a>";

    echo "<a class='btn mingpian' href='index_card.php'>名片码生成</a>";

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

    