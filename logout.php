<?php
	session_start();
	require_once("classlib.php");
	$user = new current();

	$user->logout();

	header("Location: index.php");
	exit();
?>