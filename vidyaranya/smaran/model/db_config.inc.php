<?php
	//--- database configuration
	$DATABASE_HOST = "localhost";
	$DATABASE_DB = "smaran";
	$DATABASE_PWD = "";
	$DATABASE_UID = "root";
	
	$bd = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD) or die("Could not connect database");
	mysql_select_db($DATABASE_DB, $bd) or die("Could not select database");
?>