<?php
	include_once ("db_config.inc.php");
	$ops =  $_REQUEST['operation'];


	switch ($ops ) {
    
	case "auth":
     echo authUser();
    break;

    case "signup":
     echo signup();
    break;
	
	
	case "getAllTopics":
		 $jsonString = getAlltopics();
		if($jsonString != null && strlen($jsonString)>0){
			if(strrpos($jsonString, "false") == true){
			echo substr($jsonString, 0, strlen($jsonString)-7) . "]"; 
			}else{
			echo "No Sessions Created!!";
			}
		}
    break;


	case "getTopicItems":
  	 $jsonStringItems = getTopicItems();
		if($jsonStringItems != null && strlen($jsonStringItems)>0){
			if(strrpos($jsonStringItems, "false") == true){
			echo substr($jsonStringItems, 0, strlen($jsonStringItems)-7) . "]"; 
			}else{
			echo "No Items Created!!";
			}
		}
    break;

	case "addTopic":
     echo addTopic();
    break;

	case "addItem":
     echo addItem();
    break;

    case "updateItemOrder":
     echo updateItemOrder();
    break;
	
}


    function authUser(){		
			global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT username FROM users WHERE username='".$_REQUEST['u']."' AND password='".$_REQUEST['p']."'";
						
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow = mysql_fetch_array($nResult) )
								{     
									return "true";
								}
							}
						}
				}
			
			}
			return "false";
		}


		function getUser(){		
			global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT username FROM users WHERE username='".$_REQUEST['u']."'";
						
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow = mysql_fetch_array($nResult) )
								{     
									return "true";
								}
							}
						}
				}
			
			}
			return "false";
		}


		function signup(){
		
			global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
	$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
	if ($nConnection)
	{
		//--- get maximum count of users
		if (mysql_select_db($DATABASE_DB, $nConnection))
		{	
			

			if(getUser() == "true"){
			echo "User Already Exists!!";
		
			}else{

				$strQuery = "INSERT INTO users ( username, 	password, 	email ) VALUES ( '".$_REQUEST['u']."', '".$_REQUEST['p']."', '".$_REQUEST['email']."')";		

			$nResult = mysql_query($strQuery, $nConnection); 
			if (!$nResult) {
				  echo 'Invalid query: ' . mysql_error();
				}else{
				echo "true";
				}
			
			}
			 
		}
		
	}
		
		}



		
     function getAlltopics(){
		$arrRow = array();
		 	global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT * FROM topics";
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow[] = mysql_fetch_assoc($nResult) )
								{     
									
								}
							}
						}
				}
			
			}
			return json_encode($arrRow);
	 
	 }
   

	
     function getTopicItems(){

		 $arrRow = array();
		 	global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT * FROM items  WHERE topic_id='".$_REQUEST['topic_id']."'";
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow[] = mysql_fetch_assoc($nResult) )
								{     
									
								}
							}
						}
				}
			
			}
			return json_encode($arrRow);
	 
	 }
   
   function getTopic(){
	
			global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT topic FROM topics WHERE topic='".$_REQUEST['topic_name']."'";
						
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow = mysql_fetch_array($nResult) )
								{     
									return "true";
								}
							}
						}
				}
			
			}
			return "false";
		}
	
     function addTopic(){


		 global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
	$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
	if ($nConnection)
	{
		//--- get maximum count of users
		if (mysql_select_db($DATABASE_DB, $nConnection))
		{	
			

			if(getTopic() == "true"){
			echo "Session by this name already exists, Try different Name!!";
		
			}else{

				$strQuery = "INSERT INTO topics ( topic ) VALUES ( '".$_REQUEST['topic_name']."')";		

			$nResult = mysql_query($strQuery, $nConnection); 
			if (!$nResult) {
				  echo 'Invalid query: ' . mysql_error();
				}else{
				echo "true";
				}
			
			}
			 
		}
		
	}


	 
	 }
    







function getItem(){
	
			global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
			$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
			if ($nConnection)
			{
				//--- get maximum count of users
				if (mysql_select_db($DATABASE_DB, $nConnection))
				{
					   //--- read the values of the user
						$strQuery = "SELECT caption FROM  items WHERE caption='".$_REQUEST['caption']."' AND topic_id='".$_REQUEST['topic_id']."'";
						
						$nResult = mysql_query($strQuery, $nConnection);
						if ($nResult)
						{
							if (mysql_num_rows($nResult) > 0)
							{
								$n=1;
								while (	$arrRow = mysql_fetch_array($nResult) )
								{     
									return "true";
								}
							}
						}
				}
			
			}
			return "false";
		}
	
     function addItem(){


		 global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
	$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
	if ($nConnection)
	{
		//--- get maximum count of users
		if (mysql_select_db($DATABASE_DB, $nConnection))
		{	
			

			if(getItem() == "true"){
			echo "Item by this name already exists, Try different Name!!";
		
			}else{

				$strQuery = "INSERT INTO items (`caption`, `image_src`, `audio_src_mp3`, `audio_src_ogg`, `order`, `topic_id`) VALUES ('".$_REQUEST['caption']."' ,'".$_REQUEST['image_src']."','".$_REQUEST['audio_src_mp3']."','".$_REQUEST['audio_src_ogg']."','".$_REQUEST['order']."','".$_REQUEST['topic_id']."')";		

			$nResult = mysql_query($strQuery, $nConnection); 
			if (!$nResult) {
				  echo 'Invalid query: ' . mysql_error();
				}else{
				echo "true";
				}
			
			}
			 
		}
		
	}

	 }
	
    
    

    
  function updateItemOrder(){

	  global $DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD,$DATABASE_DB;
	$nConnection = mysql_connect($DATABASE_HOST, $DATABASE_UID, $DATABASE_PWD);
	if ($nConnection)
	{
		//--- get maximum count of users
		if (mysql_select_db($DATABASE_DB, $nConnection))
		{	
		
		$strQuery = "UPDATE `items` SET `order`='".$_REQUEST['order']."' WHERE `id`='".$_REQUEST['item_id']."'";
		$nResult = mysql_query($strQuery, $nConnection);
		
		if (!$nResult) {
				  echo 'Invalid query: ' . mysql_error();
				}else{
				echo "true";
				}


		}
		
	}
	
	}
    





		
?>