<?php
include 'connection.php';

if(isset($_POST["submit"]))
{
	//for product
	$finalProdcutName;
	$finalProdcutType;
	$finalProductColor;
	$finalProductDimension;
	$finalProductQuantity;
	$finalProductMadeBy;
	$finalProductCostPrice;
	$finalProdcutSellingPrice;
	$finalProductComments;
	$finalProdcutImage;
	$finalProdcutTag;

	if(isset($_POST[""]))
	 	$invProductName = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProdcutType = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProductColor = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProductDimension = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProductQuantity = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProductMadeBy = $_POST[""]; 
	if(isset($_POST[""]))
	 	$finalProductCostPrice = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProdcutSellingPrice = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProductComments = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProdcutImage = $_POST[""];
	if(isset($_POST[""]))
	 	$finalProdcutTag = $_POST[""];

	if(connection)
	 {
	 	if(!mysqli_query("INSERT INTO Products VALUES()"))
	 		echo "error";
	 	if(!mysqli_query("INSERT INTO TransactionStatus VALUES()"))
	 		echo "error";
	 }
	 else
	 {
	 	die('Could not connect: Try Later');
	 }


}

?>