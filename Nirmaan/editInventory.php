<?php
include 'connection.php';

if(isset($_POST["Update"]))
{
	//variables
	$invProductName;
	$invProductPrice;
	$invProductImage;
	$invProductTag;
	$invProductQuantity;

	 if(isset($_POST[""]))
	 	$invProductName = $_POST[""];
	 if(isset($_POST[""]))
	 	$invProductPrice = $_POST[""];
	 if(isset($_POST[""]))
	 	$invProductImage = $_POST[""];
	 if(isset($_POST[""]))
	 	$invProductTag = $_POST[""];
	 if(isset($_POST[""]))
	 	$invProductQuantity = $_POST[""];

	 if(connection)
	 {
	 	if(!mysqli_query("UPDATE Inventory SET WHERE InventoryNumber = '$inventoryNumber'"))
	 		echo "error";
	 	if(!mysqli_query("INSERT INTO TransactionStatus VALUES($inventoryNumber,invProductQuantity,invProductQuantity,invTransactionDate,invComment)"))
	 		echo "error";
	 }
	 else
	 {
	 	die('Could not connect: Try Later');
	 }
}

?>