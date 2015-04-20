<?php
require_once "adminhead.php";
require_once "../phplib/dbAPI.php";

$sucUrl = "";
$failUrl = "";

function succeed() {
	global $sucUrl;
	header("location: $sucUrl");
}

function fail($message) {
	global $failUrl;
	echo $message, "\n";
	$id = $_POST["id"];
	if ($id) {
		echo "<a class='btn left_btn' href='$failUrl?id=$id'>返回</a>";
	} else {
		echo "<a class='btn left_btn' href='$failUrl'>返回</a>";
	}
	exit(0);
}

function uploadImage($subdir) {
	$arrType = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
	$max_size = '2000000'; // 最大文件限制（单位：byte）
	$upfile = './upload' . '/' . $subdir; //图片目录路径
	$file = $_FILES['imageurl'];
	//判断提交方式是否为POST
	if (!is_uploaded_file($file['tmp_name'])) {
		//判断上传文件是否存在
		return "NULL";
	}
	if ($file['size'] > $max_size) {
		//判断文件大小
		fail("上传文件太大!");
	}
	if (!in_array($file['type'], $arrType)) {
		//判断图片文件的格式
		fail("上传文件格式不对！");
	}
	if (!file_exists($upfile)) {
		// 判断存放文件目录是否存在
		mkdir($upfile, 0777, true);
	}
	$imageSize = getimagesize($file['tmp_name']);
	$img = $imageSize[0] . '*' . $imageSize[1];
	$fname = $file['name'];
	$ftype = explode('.', $fname);
	$fname = md5($ftype[0] . time()) . "." . $ftype[1];
	$picName = $upfile . "/" . $fname;

	if (file_exists($picName)) {
		fail("同文件名已存在！");
	}
	if (!move_uploaded_file($file['tmp_name'], $picName)) {
		fail("移动文件出错！");
	}
	return $picName;
}

function getData($key) {
	if (array_key_exists($key, $_POST)) {
		return $_POST[$key];
	}
	echo $key;
	fail("请填写完整！");
}

function updateNew() {
	$args = array();
	$tmp = getData('id');
	$is_update = strlen($tmp);
	if ($is_update > 0) {
		$args['id'] = intval($tmp);
	}
	$args['type'] = intval(getData('type'));
	$args['title'] = getData('title');
	$args['content'] = getData('content');
	$args['preview'] = $args['content'];
	$args['is_show'] = intval(getData('is_show'));
	$args['url'] = uploadImage('news');
	if ($is_update > 0 && $args['url'] == 'NULL') {
		$args['url'] = getData('oldurl');
	}
	if (!db_insertNew($args)) {
		if ($is_update > 0) {
			fail("更新失败！");
		} else {
			fail("添加失败！");
		}
	}
}

function updateWork() {
	$args = array();
	$tmp = getData('id');
	$is_update = strlen($tmp);
	if ($is_update > 0) {
		$args['id'] = intval($tmp);
	}
	$args['name'] = getData('name');
	$args['author'] = getData('author');
	$args['content'] = getData('content');
	$args['category_id'] = intval(getData('category_id'));
	$args['tags'] = getData('tags');
	$args['url'] = uploadImage('works');
	if ($is_update > 0 && $args['url'] == 'NULL') {
		$args['url'] = getData('oldurl');
	}
	if (!db_insertWork($args)) {
		if ($is_update > 0) {
			fail("更新失败！");
		} else {
			fail("添加失败！");
		}
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['method'] == "new") {
		$sucUrl = "./news.php";
		$failUrl = "./news_add.php";
		updateNew();
		succeed();
	}
	if ($_POST['method'] == "work") {
		$sucUrl = "./works.php";
		$failUrl = "./works_add.php";
		updateWork();
		succeed();
	}
} else {
	fail("非法的请求");
}

?>