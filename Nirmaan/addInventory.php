<?php
include 'connection.php';

if(isset($_POST["submit"]))
{

	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["imageInputFile"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["imageInputFile"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["imageInputFile"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["imageInputFile"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["imageInputFile"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}


	//variables
	$invProductName;
	$invProductPrice;
	$invProductImage;
	$invProductTag;
	$invProductQuantity;

	//for Status
	$invTransactionDate = getdate();
	$invComment;

	 if(isset($_POST["name"]))
	 	$invProductName = $_POST["name"];
	 if(isset($_POST["pricePerUnit"]))
	 	$invProductPrice = $_POST["pricePerUnit"];
	 //if(isset($_POST["imageInputFile"]))
	 	$invProductImage = $_FILES["imageInputFile"]["name"];
	 
	 //addslashes(file_get_contents($_FILES['productImage']['invProductImage'];
	 if(isset($_POST["tags"]))
	 	$invProductTag = $_POST["tags"];
	 if(isset($_POST["noOfUnits"]))
	 	$invProductQuantity = $_POST["noOfUnits"];
	 if(isset($_POST["comments"]))
	 	$invComment = $_POST["comments"];
	 if(isset($_POST['location']))
	 	$invLocation = $_POST['location'];
	 
	 if($connection)
	 {
	 	if(!mysql_query("INSERT INTO inventory(name,image,price,tags,location) VALUES('$invProductName','$invProductImage','$invProductPrice','$invProductTag','$invLocation');",$connection))
	 		echo "error";

	 	//to get the latest id from inventory table
	 	$query = "select id from inventory ORDER BY ID DESC LIMIT 1";
	 	$result = mysql_query($query);
		$obj = mysql_fetch_object($result);
		$i_id= $obj->id;
		echo "i_id=".$i_id;

		$date = date("Y-m-d h:i:s");
		echo $date;
		$query2= "INSERT INTO inventory_status(p_id,i_id,transaction_type,initial_quantity,final_quantity,t_date,comments,location) values(NULL,$i_id,'acquired',0,$invProductQuantity,'$date','$invComment','$invLocation')";
		if(!mysql_query($query2,$connection)){
			echo 'Registering Transaction Unsuccessful. Please try again';
		}


	 	/*if(!mysqli_query("INSERT INTO inventory_status VALUES($inventoryNumber,invProductQuantity,invProductQuantity,invTransactionDate,invComment)"))
	 		echo "error";*/
	 }
	 else
	 {
	 	die('Could not connect: Try Later');
	 }


}
?>