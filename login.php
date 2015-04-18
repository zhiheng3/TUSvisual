<?php
session_start();
if ($_POST['password'] == "123456") {
	$_SESSION['username'] = $_POST['username'];
}
?>
