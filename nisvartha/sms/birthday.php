<?php

include 'database.php';
include 'sms.php';



$month=date("m");

$day=date("d");

//echo $month;

//echo $day;

$sql = "SELECT * FROM student";


	$result = $conn->query($sql);

	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$date=new DateTime($row['DOB']);
		
			$month_x=$date->format('m');
		
			$day_y=$date->format('d');
			
		//	echo "<br>";
		
		//	echo $month_x." ",$day_y;
			
			//if($month==$month_x && $day_y==$day)
			//{
			
			$arr=array('7795217244');
			//sendsms(7760311190,$arr,"happy Birthday after");
			
		//
		$httpcode=sendsms(7760311190,$arr,"Happy Birthday After");
				
			//	$httpcode=200;
			if($httpcode==200)
			{
			$httpcode=1;
			}
			else{
			$httpcode=0;
			}
			
			$sql2=" INSERT INTO message (mentorID,studentID,smsID,status) VALUES(2,{$row['studentID']},2,{$httpcode})";
			
			if ($conn->query($sql2) === TRUE) {
			}
			
			
			//}
			
			

		}
		
		
	}


?>