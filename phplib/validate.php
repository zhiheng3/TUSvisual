<?php
session_start();
if ($_SESSION['user'] != "admin") {
	header("location: ./login.html");
}
?>