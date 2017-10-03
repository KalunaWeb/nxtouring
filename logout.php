<?php
	session_start();
	require_once("classes.php");
	$db = new db();
	$user = new Auth($db);

	$user->logout();

	header("Location: index.php");
	exit();
?>