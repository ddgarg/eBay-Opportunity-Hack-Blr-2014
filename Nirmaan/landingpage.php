<?php
	session_start();
	if($_SESSION['name'] != null && $_SESSION['role'] == 'volunteer'){
		echo '

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Blueprint: Split Layout</title>
		<meta name="description" content="Blueprint: Split Layout" />
		<meta name="keywords" content="website template, layout, css3, transition, effect, split, dual, two sides, portfolio" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/demo1.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$("#rawmaterials").click(function(){
					$(location).attr("href","http://vasavitemple.org/hackathon/inventory/rawmaterials.php");
				});

				$("#products").click(function(){
alert("hi");
				});
			});
		</script>
	</head>
	<body>
		<div class="container">
			<div id="splitlayout" class="splitlayout">
				<div class="intro">
					<div class="side side-left">
						<header class="codropsheader clearfix">
							<span> <img src="img/nirmaan_logo.png"> </img><span class="bp-icon bp-icon-about" data-content="Nirmaan is a constructive citizen movement for an empowered India, thereby making the world a better place to live in. Nirmaan was founded on 12th February, 2005 by a group of BITS-Pilani University students with a passion for humanity and to fulfill our responsibility towards our less privileged brothers & sisters."></span></span>
						</header>
						<div class="intro-content" id="rawmaterials">
							<div class="profile"><img src="img/index.gif" alt="profile1"></div>
							<h1><span>Raw Materials </span><span>Check Availability!</span></h1>
						</div>
						<div class="overlay"></div>
					</div>
					<div class="side side-right">
						<div class="intro-content" id="products">
							<div class="profile"><img src="img/product.gif" alt="profile2"></div>
							<h1><span>Products</span><span>Ready to be Shipped!</span></h1>
						</div>
						<div class="overlay"></div>
					</div>
				</div><!-- /intro -->
				<div class="page page-right">
					
				</div><!-- /page-right -->
				<div class="page page-left">
					
				</div><!-- /page-left -->
				<a href="#" class="back back-right" title="back to intro">&rarr;</a>
				<a href="#" class="back back-left" title="back to intro">&larr;</a>
			</div><!-- /splitlayout -->
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/cbpSplitLayout.js"></script>
	</body>
</html>

';
}
else
	echo 'error';
?>
