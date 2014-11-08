<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host="localhost";
$regid=$_post['regid'];
$username="root";
$password="";
$db_name="Vazhai";
$tbl_name="student";
$link=mysql_connect("$host","$username","password");
mysql_select_db("$db_name",$link);
$sql="select * from student where regid='$regid'";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);
?>
<html>
<head>
<title>STUDENT FORM</title>
<h4>STUDENT FORM</h4>
</head>
<body>
<form action="studentformcode.php" method="post">
  <table>
   <tr><td>*Year of Admission</td><td><input type="text" name="yoj" required value=<?php echo($row['yoj']);?>></td></tr>
   <tr><td>*Registration ID</td><td><input type="text" name="regid" required value=<?php echo($row['regid']);?>></td></tr>
   <tr><td>*Name</td><td><input type="text" name="name" required value=<?php echo($row['name']);?>></td><td></td><td>*Upload photo</td><td><input type="file" name="pic" required></td></tr>
   <tr><td>*Gender</td><td>Male<input type="radio" name="sex" value="Male" ></td><td>Female<input type="radio" name="sex" value="Female"></td></tr>
   <tr><td>*Date of Birth</td><td><input type="date" name="dob" value=<?php echo($row['dob']);?>></td></tr>
   <tr><td>*Father Status</td><td>Available<input type="radio" name="fs" value="Available"></td><td>Not Available<input type="radio" name="fs" value="Not available"></td><td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspLate<input type="radio" name="fs" value="Late"></td></tr>
   <tr><td>*Father Name</td><td><input type="text" name="fname" required value=<?php echo($row['fname']);?>></td></tr>
   <tr><td>&nbspFather Occupation</td><td><input type="text" name="foccu" value=<?php echo($row['foccu']);?> ></td></tr>
   <tr><td>*Mother Status</td><td>Available<input type="radio" name="ms" value="Available"></td><td>Not Available<input type="radio" name="ms" Not available"></td><td> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspLate<input type="radio" name="ms" value="Late"></td></tr>
   <tr><td>*Mother Name</td><td><input type="text" name="mname" required value=<?php echo($row['mname']);?>></td></tr>
   <tr><td>&nbspMother Occupation</td><td><input type="text" name="moccu" value=<?php echo($row['moccu']);?> ></td></tr>
   <tr><td>&nbspGaurdian Name</td><td><input type="text" name="gname" value=<?php echo($row['gname']);?>> </td></tr>
   <tr><td>&nbspGuardian Occupation</td><td><input type="text" name="goccu" value=<?php echo($row['goccu']);?> ></td></tr>
   <tr><td>Contact Numbers:</td><td>Mobile</td><td><input type="text" name="cnumm" value=<?php echo($row['cnumm']);?>></td></tr>
   <tr><td></td><td>Home</td><td><input type="text" name="cnumh" value=<?php echo($row['cnumh']);?>></td>
   <tr><td></td><td>Gaurdian</td><td><input type="text" name="cnumg" value=<?php echo($row['cnumg']);?>></td>
   <tr><td>*Address</td><td><textarea rows="10" cols="30" name="addr" value=<?php echo($row['addr']);?>></textarea></td></tr>
   <tr><td>*Standard</td><td><input list="std1"><datalist id="std1" value=<?php echo($row['std1']);?>><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></datalist></td></tr>
   <tr><td>&nbspSchool</td><td><input type="text" name="schl" value=<?php echo($row['schl']);?>></td></tr>
   <tr><td>&nbspInterests</td><td><textarea rows="5" cols="20" name="intrs" value=<?php echo($row['intrs']);?>></textarea></td></tr>
    <tr><td>*Physically Challenged</td><td>&nbsp &nbspYes<input type="radio" name="pc" value="Yes" ></td><td>No<input type="radio" name="pc" value="No"></td></tr>
   <tr><td>If yes details</td><td><textarea rows="10" cols="30" name="pcdt" value=<?php echo($row['pcdt']);?>></textarea></td></tr>
   <tr><td>&nbspReason for Selection</td><td><input type="text" name="resec" value=<?php echo($row['resec']);?> ></td></tr>
    <tr><td>&nbspBlood group</td><td><input type="text" name="bldgp" value=<?php echo($row['bldgp']);?> ></td></tr>
    <tr><td>*Mentor name</td><td><input type="text" name="mename" value=<?php echo($row['mename']);?> ></td></tr>
     <tr><td>&nbspMentor contact</td><td><input type="text" name="menct" value=<?php echo($row['menct']);?> ></td></tr>
   <tr><td>Student Selection Form</td><td></td><td><input type="file" name="ss"></td></tr>
	<tr><td>Ward Profile Details</td><td>Year 1<td><input type="file" name="f1"></td></tr>
    <tr><td></td><td>Year 2</td><td><input type="file" name="f2"></td></tr>
    <tr><td></td><td>Year 3</td><td><input type="file" name="f3"></td></tr>
     <tr><td></td><td>Year 4</td><td><input type="file" name="f4"></td></tr>
     <tr><td></td><td>Year 5</td><td><input type="file" name="f5"></td></tr>
     <tr><td></td><td>Year 6</td><td><input type="file" name="f6"></td></tr>
     <tr><td>*TIG Team</td><td><input type="text" name="tigt" required value=<?php echo($row['tigt']);?>></td></tr>
    <tr><td></td><td><input type="submit" value="Upload details" name="studformsub"></td></tr>
</form>
</body>
</html>