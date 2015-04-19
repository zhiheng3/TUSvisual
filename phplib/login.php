<?php
/**
 * 用户的注册和登录处理，注册时用户名长度为3~32个字符，只能包括字母和数字，不能用纯数字。
 * 密码采用MD5+salt存储，salt的生成方法为用户名+时间戳进行MD5后取前10位，保存的密码为password+salt进行MD5
 */

require_once "dbAPI.php";
require_once "config.php";

//验证用户名是否合法
//返回： 合法返回true，否则返回false
function validateUsername($username) {
	db_connect();
	$len = strlen($username);
	$letter = false;
	if ($len < 3 || $len > 32) {
		return false;
	}
	for ($i = 0; $i < $len; ++$i) {
		$tmp = $username[$i];
		if ($tmp >= '0' && $tmp <= '9') {
			continue;
		}
		if ($tmp >= 'A' && $tmp <= 'Z') {
			$letter = true;
			continue;
		}
		if ($tmp >= 'a' && $tmp <= 'z') {
			$letter = true;
			continue;
		}
		return false;
	}
	if (!$letter) {
		return false;
	}
	return true;
}

//验证密码是否合法
//返回：合法返回true，否则返回false
function validatePassword($password) {
	db_connect();
	$len = strlen($password);
	if ($len < 4) {
		return false;
	}

	return true;
}

//注册账号
//参数：用户名username，密码password
function lg_register($args) {
	db_connect();
	$username = $args["username"];
	$password = $args["password"];
	global $con;
	$result = array();

	if (!validateUsername($username)) {
		return err_message(1, "用户名不合法");
	}

	if (!validatePassword($password)) {
		return err_message(1, "密码不合法");
	}

	$salt = md5($username . strval(time()));
	if (!$salt) {
		return err_message(4, "服务器未知错误");
	}
	$salt = substr($salt, 0, 10);

	$password = md5($password . $salt);
	if (!$password) {
		return err_message(4, "服务器未知错误");
	}

	$sql = "INSERT INTO vis_user (username, password, salt) VALUES ('$username', '$password', '$salt')";
	if (mysql_query($sql, $con)) {
		$result["code"] = 0;
		return $result;
	} else {
		return err_message(1, "用户名已被注册");
	}
}

//验证账号
//参数：用户名username，密码password
function lg_validate($args) {
	db_connect();
	$username = $args["username"];
	$password = $args["password"];
	global $con;
	$result = array();

	$sql = "SELECT * FROM vis_user WHERE username='$username'";
	$userdata = mysql_query($sql, $con);
	if (!$userdata) {
		return err_message(3, "数据库错误");
	}
	$userdata = mysql_fetch_array($userdata);
	if (!$userdata) {
		return err_message(1, "用户名或密码错误");
	}

	$salt = $userdata["salt"];
	$password = md5($password . $salt);
	if (!$password) {
		return err_message(4, "服务器未知错误");
	}

	if ($password == $userdata["password"]) {
		$result["code"] = 0;
		return $result;
	} else {
		return err_message(1, "用户名或密码错误");
	}
}

//修改密码
//参数：用户名username，新密码password
function lg_modify($args) {
	db_connect();
	$username = $args["username"];
	$password = $args["password"];
	global $con;
	$result = array();

	if (!validatePassword($password)) {
		return err_message(1, "密码不合法");
	}

	$sql = "SELECT * FROM vis_user WHERE username='$username'";
	$userdata = mysql_query($sql, $con);
	if (!$userdata) {
		return err_message(3, "数据库错误");
	}
	$userdata = mysql_fetch_array($userdata);
	if (!$userdata) {
		return err_message(1, "用户名或密码错误");
	}

	$salt = $userdata["salt"];
	$password = md5($password . $salt);
	if (!$password) {
		return err_message(4, "服务器未知错误");
	}

	$sql = "UPDATE vis_user SET password='$password' WHERE username='$username'";
	if (mysql_query($sql, $con)) {
		$result["code"] = 0;
		return $result;
	} else {
		return err_message(3, "数据库错误");
	}
}

?>
