<?php

$smsid=$_GET['SmsSid'];
$from=$_GET['from'];
$to=$_GET['To'];
$date=$_GET['Date'];
$msg=$_GET['body'];

$date=new DateTime();

$sql = "SELECT mentorID,studentID FROM student where mobile=".from;
$result = $conn->query($sql);


$student = $result->fetch_assoc();
		
		
$sql=" INSERT INTO sms (content,date) VALUES('".$msg."',{$date})";		
		
if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$id=$conn->insert_id;
		
$httpcode=1;		
$reply=1;
		
$sql2=" INSERT INTO message (mentorID,studentID,smsID,status,reply) VALUES({$student['mentorID']},{$student['studentID']},{$id},{$httpcode},{$reply})";
			
			if ($conn->query($sql2) === TRUE) {
			}



echo "Message Delivered";
		
		



?>