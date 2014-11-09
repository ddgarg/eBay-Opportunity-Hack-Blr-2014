<?php
	session_start();
	include 'connection.php';
	//get data
	if(isset($_POST['username'])){
		$user_name = stripslashes($user_name);
		$user_name = mysql_real_escape_string($_POST['username']);
		
	}
	echo "user = ".$user_name;
	if(isset($_POST['password'])){
		$password = stripslashes($password);
		$password = mysql_real_escape_string($_POST['password']);
		$password = md5($password);
		echo "pwd = ".$password;

	}

	$query = "select * from users where username='".$user_name."' and password='".$password."'";
	$result=mysql_query($query,$connection);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		$role="";
		while($row = mysql_fetch_array($result))
		{
			$role = $row[5];
		}
		if($role == "admin"){
			session_start();
			$_SESSION['name'] = $user_name;
			$_SESSION['role'] = 'admin';
			header("location:adminlandingpage.php");
		}
		else{
			session_start();
			$_SESSION['name'] = $user_name;
			$_SESSION['role'] = 'volunteer';
			header("location:landingpage.php");
		}
	}
	else {
		echo "Wrong Username or Password";
	}
?>