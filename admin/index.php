<?php
session_start();
if ($_SESSION['user'] != "admin") {
	header("location: ./login.html");
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>启迪视觉后台</title>
    <!-- Javascript -->
    <script src="../static/js/jquery-1.8.2.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="./static/images/shijue.ico" media="screen" />
</head>
<body>
<div class="home_top">
    <div class="home_top_left">启迪视觉后台管理</div>
    <div class="home_log">您好,<?php echo $_SESSION['user'];?><a href="javascript:logout();">注销</a></div>
</div>
<div>
    <div class="home_left">
        <div class="home_left_sub" name="home">主页</div>
        <div class="home_left_sub" name="news">新闻管理</div>
        <div class="home_left_sub" name="works">作品管理</div>
    </div>
    <div class="home_right">
        <iframe class="right_iframe" src="./home.php" id="iframe"  frameBorder=0 scrolling=no></iframe>
    </div>
</div>

</body>
<script>
    $(function () {
        $('.home_left_sub').click(function(){
            var name=$(this).attr('name');
            $('.right_iframe').attr("src","./"+name+".php");
        });
    });

</script>
<script>
    //log out
    function logout(){
        $.post("../phplib/ajax.php",{
            "method":"lg_logout"
        },function(data){
var result = JSON.parse(data);
console.log(result);
if (result["code"] == 0){
    location.href="./login.html";
}
        });
    }
</script>
<style>
    /* ------- This is the CSS Reset ------- */

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre, a,
    abbr, acronym, address, big, cite, code, del,
    dfn, em, img, ins, kbd, q, s, samp, small,
    strike, strong, sub, sup, tt, var, u, i, center,
    dl, dt, dd, ol, ul, li, fieldset, form, label,
    legend, table, caption, tbody, tfoot, thead, tr,
    th, td, article, aside, canvas, details, embed,
    figure, figcaption, footer, header, hgroup, menu,
    nav, output, ruby, section, summary, time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    body{
        font-family: "微软雅黑", "Microsoft Yahei", Arial, Helvetica, sans-serif;
    }
    .home_top{
        width: 100%;
        height: 80px;
        background: #208ed3;
    }

    .home_left{

        width: 200px;
        min-height:550px ;
        border-right: 1px solid #208ed3;
        float: left;
        padding: 5px;
    }
    .home_right{
        background: #FFF;
        position: absolute;
        width: auto;
        height: auto;
        top: 80px;
        left: 215px;
        right: 0px;
        bottom: 0px;
        z-index: 1;

    }
    .right_iframe{
        width: 100%;

        border: none;
        height: 581px;
    }
    .home_left_sub{
        height: 35px;
        line-height: 35px;
        width: 98%;
        border-left: 3px solid #6BD318;
        font-family: "微软雅黑", "Microsoft Yahei", Arial, Helvetica, sans-serif;
        font-weight: 700;
        color: #fff;
        background: #d3d3d3;
        padding-left: 5px;
        margin: 5px 0px;
    }
    .home_top_left{
        float: left;
        font-size: 35px;
        color: #fff;
    }
    .home_log{
        float: right;
        margin-top: 50px;
        margin-right: 30px;
    }

    .home_log a{
        text-decoration: none;
        margin-left: 30px;
    }
</style>
</html>
