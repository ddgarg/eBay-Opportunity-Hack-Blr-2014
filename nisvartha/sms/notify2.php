<?php
include 'header.php';
include 'database.php';

$sql = "SELECT * FROM student,mentor where student.mentorID=mentor.mentorID ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {  ?>

<body style= "background: #00FFFF">
<div id="header_container" style="margin-left: 100px">
				<div id="top_header">
					<div id="dateTime">Sunday, 9-11-2014</div>
				</div>
				<div id="main_header">
					<div id="logo_placeholder">
						<a href="index.php"><img src="images/nisvartha_logo.png" width="265" height="153" alt="Nisvartha Foundation"/></a>
					</div>
				</div>
			</div>
			<div id="pageHeader" style='margin-left: 100px'>
				<h1>Student Details</h1>
			</div>
<br>
<br>
<br>
<!--<button type="button" style="margin-left: 180px" onclick= run()>Send SMS To All</button>
-->
<div class="table-responsive" style ="width: 73%;margin-left: 100px">
<div class="checkbox">
  <label>
    <input type="checkbox" value="" id="selectall">
    Select All
  </label>
</div>
<table id="myTable" class="display table" >  
        <thead style= "background: #7B68EE	">  
          <tr>  
            <th>Serial</th>  
            <th>Name</th>  
            <th>mobile</th>  
            <th>mentorName</th>  
          </tr>  
        </thead>  

    <tbody>
    <?php while($row = $result->fetch_assoc()) 
	{ 
	echo "<tr id='".$row["studentID"]."'>";
	
	echo "<td>".$row["studentID"];
	echo"<td>".  $row["name"];
	echo"<td>". $row["mobile"];
	echo"<td>" .$row["mname"];
	echo"</tr>";
	
       // echo "serial: " . $row["studentID"]. " - Name: " . $row["name"]. " -mobile " . $row["mobile"]. " -mentor " . $row["mentorID"]."<br>";
    }
?>
</tbody></table>

<input id="send_msg" type="button" class="btn btn-default" value="Send Message" />

<?php include 'footer.php';?>
</body>

<br>


<?php	
} else {
    echo "0 results";
}
$conn->close();
?>
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>

<script src="table.js"></script

</html>