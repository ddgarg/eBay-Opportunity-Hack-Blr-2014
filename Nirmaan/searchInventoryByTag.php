<?php

	include 'connection.php';
	$tag = $_POST['tag'];
	
	$query = "select * from inventory where tags ='".$tag."'";
	$result=mysql_query($query,$connection);

	$data = "<table class='table table-striped table-bordered table-hover' >";
	$data.= "<thead><tr><th>Name</th><th>Price</th><th>Tags</th><th>Location</th></thead>";
	$data.= "<tbody>";
	while($row = mysql_fetch_array($result))
	{
		$data.="<tr>";
		$data.="<td>".$row[1]."</td>";
		$data.="<td>".$row[3]."</td>";
		$data.="<td>".$row[4]."</td>";
		$data.="<td>".$row[5]."</td>";
		$data.="</tr>";
	}
	$data.="</tbody></table>";
	echo $data;	

?>