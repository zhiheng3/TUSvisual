<?php
/**
 * database API
 */
require_once "config.php";

$con = null;

//Connect to database
//Return: Bool
function db_connect() {
	global $config, $con;
	$server = $config["dbserver"];
	$user = $config["dbuser"];
	$password = $config["dbpassword"];
	$name = $config["dbname"];
	$con = mysql_connect($server, $user, $password);
	if (!$con) {
		return false;
	}
	mysql_set_charset("utf8");
	mysql_select_db($name, $con);
	return true;
}

function db_getNews() {
	db_connect();
	$query = mysql_query("SELECT * FROM vis_news WHERE is_show = 1 ORDER BY updatetime DESC");
	$result = array();
	while ($row = mysql_fetch_assoc($query)) {
		array_push($result, $row);
	}
	return $result;
}

function db_getLists($category_id) {
	if (!$category_id) {
		$category_id = 0;
	}
	db_connect();
	if ($category_id == 0) {
		$query = mysql_query("SELECT * FROM (vis_categories NATURAL JOIN vis_works)");
	} else {
		$query = mysql_query("SELECT * FROM (vis_categories NATURAL JOIN vis_works) WHERE category_id = $category_id");
	}
	$result = array();
	while ($row = mysql_fetch_assoc($query)) {
		array_push($result, $row);
	}
	return $result;
}

function db_getWork($id) {
	if (!$id) {
		return false;
	}
	db_connect();
	$query = mysql_query("SELECT * FROM vis_works WHERE id = $id");
	$result = mysql_fetch_assoc($query);
	return $result;
}

function db_incWorkNumber($id, $key) {
	if (!$id) {
		return false;
	}
	db_connect();
	$query = mysql_query("UPDATE vis_works SET $key = $key + 1 WHERE id = $id");
	return $query;
}

function err_message($code, $message) {
	$result = array();
	$result["code"] = $code;
	$result["result"] = $message;
	return $result;
}
?>
