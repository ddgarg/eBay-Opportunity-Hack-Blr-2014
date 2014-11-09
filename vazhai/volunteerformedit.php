<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host="localhost";
$regid=$_post['ridv'];
$username="root";
$password="";
$db_name="Vazhai";
$tbl_name="Volunteer";
$link=mysql_connect("$host","$username","password");
mysql_select_db("$db_name",$link);
$sql="select * from Volunteer where ridv=$ridv;
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
?><html>
<head>
<title>VOLUNTEER FORM</title>
<h4>VOLUNTEER FORM</h4>
</head>
<body>
<form action="volunteerform.php" method="post">
<table>
<tr><td>*Year of Joining</td><td><input type="text" name="yojv" required value=<?php echo($row['yojv']);?>></td></tr>
<tr><td>*Registration ID</td><td><input type="text" name="ridv" required value=<?php echo($row['ridv']);?>></td><td>*Upload photo</td><td><input type="file" name="picv" required></td></tr>
<tr><td>*Name</td><td><input type="text" name="namev" required value=<?php echo($row['namev']);?>></td></tr>
<tr><td>*Contact Number</td><td><input type="text" name="cnumv" required value=<?php echo($row['cnumv']);?>></td></tr>
 <tr><td>*Gender</td><td>Male<input type="radio" name="sexv value="Male"></td><td>Female<input type="radio" name="sexv" value="Female"></td></tr>
<tr><td>*EmailID</td><td><input type="text" name="eidv" required value=<?php echo($row['eidv']);?>></td></tr>
<tr><td>*Role</td><td>Mentor<input type="radio" name="rolev" name="Mentor" ></td><td>Supporter<input type="radio" name="rolev" name="Supporter"></td><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspContributer<input type="radio" name="rolev" value="Contributer"></td></tr>
<tr><td>*Status</td><td>Active<input type="radio" name="statv" value="Active" ></td><td>Inactive<input type="radio" name="statv" value="Inactive"></td></tr>
<tr><td>&nbspOccupation</td><td><input type="text" name="occv" value=<?php echo($row['occv']);?>></td></tr>
<tr><td>*Date of Birth</td><td><input type="date" name="dobv" value=<?php echo($row['dobv']);?>></td></tr>
<tr><td>&nbspBlood group</td><td><input type="text" name="bldgpv" value=<?php echo($row['bldgpv']);?> ></td></tr>
<tr><td>&nbspNative</td><td><input type="text" name="natv" value=<?php echo($row['natv']);?> ></td></tr>
<tr><td>*Permanent Address</td><td><textarea rows="5" cols="30" name="paddv" value=<?php echo($row['paddv']);?>></textarea></td></tr>
<tr><td>&nbspCurrent Address</td><td><textarea rows="5" cols="30" name="caddv" value=<?php echo($row['caddv']);?>></textarea></td></tr>
<tr><td>*Languages Known</td><td><textarea rows="5" cols="30" name="langv" value=<?php echo($row['langv']);?>></textarea></td></tr>
 <tr><td>*TIG Team</td><td><input type="text" name="tigtv" required value=<?php echo($row['tigtv']);?>></td></tr>
<tr><td>&nbspInterests</td><td><textarea rows="5" cols="30" name="intrsv" value=<?php echo($row['intrsv']);?>></textarea></td></tr>
<tr><td>&nbspReference</td><td><input type="text" name="refv" value=<?php echo($row['refv']);?>></td></tr>
<tr><td>&nbspWard's Name</td><td><input type="text" name="wrdv" value=<?php echo($row['wrdv']);?> ></td></tr>
<tr><td>&nbspWard's Registration ID</td><td><input type="text" name="wrgid" value=<?php echo($row['wrgid']);?>></td></tr>
<tr><td>&nbspWard's Contact Number</td><td><input type="text" name="wcnumv" value=<?php echo($row['wcnumv']);?>></td></tr>
<tr><td>&nbspCurrent Sessions</td><td><textarea rows="5" cols="20" name="cursv" value=<?php echo($row['cursv']);?>></textarea></td></tr>
<tr><td>&nbspExperienced Sessions</td><td><textarea rows="5" cols="20" name="expsv"value=<?php echo($row['expsv']);?>></textarea></td></tr>
<tr><td></td><td><input type="submit" value="Upload details" name="volformsub"></td></tr>

</table></form></body></html>