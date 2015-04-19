<?php
session_start();
if ($_SESSION['user'] != "admin") {
	echo "请先登录";
	exit(0);
}
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="./static/js/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./static/css/module.css" />
    <link href="./static/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="./static/css/font-awesome-ie7.min.css" type="text/css" rel="stylesheet">


</head>
<body>
