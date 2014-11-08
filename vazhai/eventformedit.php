<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host="localhost";
$eide=$_post['eide'];
$username="root";
$password="";
$db_name="Vazhai";
$tbl_name="Event";
$link=mysql_connect("$host","$username","password");
mysql_select_db("$db_name",$link);
$sql="select * from Volunteer where eide=$eide;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
?><html>
<head>
<title>EVENT FORM</title>
<h4>EVENT FORM</h4>
</head>
<body>
<form action="eventform.php" method="post">
<table>
<tr><td>*Event ID</td><td><input type="text" name="eide" required value=<?php echo($row['eide']);?>></td></tr>
<tr><td>*Event Name</td><td><input type="text" name="ename" required value=<?php echo($row['ename']);?>></td></tr>
<tr><td>*Event Location</td><td><input type="text" name="eloc" required value=<?php echo($row['eloc']);?>></td></tr>
<tr><td>*Event Start Date</td><td><input type="date" name="esd" value=<?php echo($row['esd']);?>></td></tr>
<tr><td>*Event Start Time</td><td><input type="time" name="est" value=<?php echo($row['est']);?>></td></tr>
<tr><td>*Event End Date</td><td><input type="date" name="eed" value=<?php echo($row['eed']);?>></td></tr>
<tr><td>*Event End Time</td><td><input type="time" name="eet" value=<?php echo($row['eet']);?>></td></tr>
<tr><td>*Event Coordinator Name</td><td><input type="text" name="ecorn" required value=<?php echo($row['ecorn']);?>></td></tr>
<tr><td>*Coordinator Contact Number</td><td><input type="text" name="ccn" required value=<?php echo($row['ccn']);?>></td></tr>
<tr><td>*Session Document</td><td><input type="file" name="sdoc"></td></tr>
    <tr><td>*Schedule Document</td><td><input type="file" name="scdoc"></td></tr>
 <tr><td></td><td><input type="submit" value="Upload details" name="eventformsub"></td></tr>
</table></body></html>