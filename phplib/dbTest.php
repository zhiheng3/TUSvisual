<?php
require_once "dbAPI.php";
$args = array();
$args['id'] = 4;
$args['name'] = "222";
$args['author'] = "222";
$args['content'] = "333";
$args['category_id'] = 2;
$args['url'] = "NULL";
$args['tags'] = "bbb22";
db_insertWork($args);
?>