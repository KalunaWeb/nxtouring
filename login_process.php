<?php
session_start();

	require_once("classlib.php");
	
	if (isset($_POST['valid'])) {

		//$user = new auth($db);
		$current = new current();
		$email = $_POST['email'];
        $password = $_POST['password'];
        
        $result = $current->login($email, $password);

		switch ($result) {
			case "ok":
				echo "ok";
				break;
			case "1":
				echo "Account Not Verified";
				break;
			case "2":
				echo "Account Suspended";
				break;
			case "3":
				echo "There was a problem login in";
				break;
			case "4":
				echo "Username or Password incorrect";
				break;}
		}
?>