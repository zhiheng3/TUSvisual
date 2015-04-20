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

function db_getNews($show_hidden) {
	db_connect();
	if ($show_hidden == 1) {
		$query = mysql_query("SELECT * FROM vis_news ORDER BY updatetime DESC");
	} else {
		$query = mysql_query("SELECT * FROM vis_news WHERE is_show = 1 ORDER BY updatetime DESC");
	}
	$result = array();
	while ($row = mysql_fetch_assoc($query)) {
		array_push($result, $row);
	}
	return $result;
}

function db_getNew($id) {
	if (!$id) {
		return false;
	}
	db_connect();
	$query = mysql_query("SELECT * FROM vis_news WHERE id = $id");
	$result = mysql_fetch_assoc($query);
	return $result;
}

function db_deleteNew($id) {
	if (!$id) {
		return false;
	}
	db_connect();
	$query = mysql_query("DELETE FROM vis_news WHERE id = $id");
	return $query;
}

function db_insertNew($args) {
	if (array_key_exists('id', $args)) {
		$id = $args['id'];
	} else {
		$id = -1;
	}
	$type = $args['type'];
	$title = $args['title'];
	$url = $args['url'];
	$preview = $args['preview'];
	$content = $args['content'];
	$is_show = $args['is_show'];
	db_connect();
	if ($id == -1) {
		$query = mysql_query("INSERT INTO vis_news (news_type, title, url, preview, content, is_show)
			                  VALUES ($type, \"$title\", \"$url\", \"$preview\", \"$content\", $is_show)");
	} else {
		$query = mysql_query("UPDATE vis_news SET news_type = $type, title = \"$title\",
			                                       url = \"$url\", preview = \"$preview\",
			                                       content = \"$content\", is_show = $is_show
			                  WHERE id = $id");
	}
	return $query;
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

function db_deleteWork($id) {
	if (!$id) {
		return false;
	}
	db_connect();
	$query = mysql_query("DELETE FROM vis_works WHERE id = $id");
	return $query;
}

function db_insertWork($args) {
	if (array_key_exists('id', $args)) {
		$id = $args['id'];
	} else {
		$id = -1;
	}
	db_connect();
	$name = $args['name'];
	$author = $args['author'];
	$content = $args['content'];
	$category_id = $args['category_id'];
	$tags = $args['tags'];
	$url = $args['url'];
	if ($id == -1) {
		$query = mysql_query("INSERT INTO vis_works (name, author, content, category_id, tags, url)
			                  VALUES (\"$name\", \"$author\", \"$content\", $category_id, \"$tags\", \"$url\")");
	} else {
		$query = mysql_query("UPDATE vis_works SET name = \"$name\", author = \"$author\",
			                                       content = \"$content\", tags = \"$tags\",
			                                       url = \"$url\", category_id = $category_id
			                  WHERE id = $id");
	}
	return $query;
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
