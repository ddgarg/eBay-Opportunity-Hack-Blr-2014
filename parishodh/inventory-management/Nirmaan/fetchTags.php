<?php

	include 'connection.php';
	$query = "select distinct tags from inventory";
	$result=mysql_query($query,$connection);

	$locations = "<option value='select'>select</option>";
	
	while($row = mysql_fetch_array($result))
	{
		$locations.="<option value='".$row[0]."'>".$row[0]."</option>";
	}
	
	echo $locations;	

?>