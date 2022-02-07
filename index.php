<?php
require 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Apricot Property Solutions Portal</title>
</head>
<body style="overflow-x: hidden;">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  	<a class="navbar-brand" href="#"><img src="Logo101.jpg" height="40"></a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav mr-auto">
	      		<li class="nav-item active">
	        		<a class="nav-link" href="Login.php">Home <span class="sr-only">(current)</span></a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="Login.php">Login</a>
	      		</li>
	      		<li class="nav-item">
	        		<a class="nav-link" href="logout.php">Logout</a>
	      		</li>
	    	</ul>
	  	</div>
	</nav>
	<div>
		<div style="padding-top: 5%; padding-bottom: 1%; text-align: center;">
			<img src="Logo101.jpg"><br>
			<br>
			<h1>Welcome To Apricot Property Solutions Ltd </h1>
			<br>
			<br>
			<h3>Login to proceed</h3>
			<br>
			<br>

			
		</div>
		<center>
		<div class="col-md-4">
		<button type="button" class="btn btn-dark btn-block"><a href="Login.php" style="color:white; margin-left: auto; margin-right: auto;">Login</a></button>
	</div>
</center>
	</div>
</body>
</html>