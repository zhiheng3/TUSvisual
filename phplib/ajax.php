<?php
/**
 * 统一处理客户端的请求
 * 格式：方法method，参数args（JSON格式，可能会经过加密）
 * 返回： 返回码code（0代表成功，1代表用户输入错误，2代表外部错误，3代表内部错误，4代表未知错误），
 * 返回值result（JSON格式，可能会经过加密。若请求成功则返回对应的值，请求失败返回错误信息）
 */
require_once "dbAPI.php";
require_once "login.php";

session_start();

//解析参数
//返回：解析后的参数数组，如果解析出错则返回null
function parseArgs($json) {
	$result = json_decode($json, true);
	return $result;
}

//响应数据
function response($result) {
	$json = json_encode($result);
	echo $json;
	exit(0);
}

function aj_like($args) {
	$id = $args['id'];
	$result = array();
	if (!$id) {
		$result['code'] = 2;
		$result['result'] = "错误的参数";
		return $result;
	}
	if (db_incWorkNumber($id, "likes")) {
		$result['code'] = 0;
	} else {
		$result['code'] = 3;
		$result['result'] = "点赞失败";
	}
	return $result;
}

$method = $_POST["method"];
$args = parseArgs($_POST["args"]);
$result = array();

if (!db_connect()) {
	$result["code"] = 3;
	$result["result"] = "无法连接到数据库";
	response($result);
}

switch ($method) {
	case "aj_like":	//用户注册
		$result = aj_like($args);
		break;
	// case "lg_register":	//用户注册
	// 	$result = lg_register($args);
	// 	break;
	case "lg_login":	//用户登录
		$result = lg_validate($args);
		if ($result['code'] == 0) {
			$_SESSION['user'] = $args['username'];	}
		break;
	case "lg_modify":
		$result = lg_modify($args); 	//修改密码
		break;
	case "lg_logout":
		$result["code"] = 0;
		session_destroy();
		break;
	default:
		$result["code"] = 2;
		$result["result"] = "未知的方法";
		break;
}
response($result);
?>

