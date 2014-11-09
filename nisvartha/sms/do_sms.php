<?php

include 'database.php';
include 'sms.php';


if(isset($_POST['data']))
{

$data=json_decode($_POST['data']);
$msg=$_POST['msg'];


//echo $data;
$date=date('Y-m-d');
$sql=" INSERT INTO sms (content,date) VALUES('".$msg."',{$date})";

if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$id=$conn->insert_id;


foreach($data as $value)
{
	$sql = "SELECT mobile FROM student where studentID=".$value;
	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			
			$httpcode=sendsms(7760311190,$row['mobile'],$msg);
		
			if($httpcode==200)
			{
			$httpcode=1;
			}
			else{
			$httpcode=0;
			}
			
			$sql2=" INSERT INTO message (mentorID,studentID,smsID,status,reply) VALUES(1,{$value},{$id},{$httpcode},0)";
			
			if ($conn->query($sql2) === TRUE) {
			}
			
		}

	}

}




}






?>