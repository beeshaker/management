<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Apricot Property Solutions Portal</title>
	<style type="text/css">
		.textinput {
            width: 100%;
            min-height: 75px;
            outline: none;
            resize: none;
            border: 1px solid grey;
        }

	</style>
</head>
<body>
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
<?php
	if(isset($_POST["view"]))
{
	$sql = "SELECT u_id FROM users WHERE email ='$Username'";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{
		echo '<script>alert("The user does not exist. Please login. ")</script>';
		echo '<script>window.location="Login.php"</script>';
    }
    else
    {
    	while($row = $result->fetch_assoc()) 
    	{
    	 $incharge = $row['u_id'];
    	// echo $cid;
    	// echo $pid;
    	}
	}
}
	$p_id = $_GET["p_id"];
	$sql = "SELECT * from property where property.p_id = '$p_id';";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{
		echo '<script>alert("No complaints")</script>';
		echo '<script>window.location="Login.php"</script>';
    }
    else
    {
    	//echo '<script>alert("There are complaints ")</script>';
		//echo '<script>window.location="login.php"</script>';
    	while($row = $result->fetch_assoc()) {
    	//$incharge = $row['u_id'];
    	// echo $cid;
    	// echo $pid;
    
?>
<div style="padding-top: 2%; padding-bottom: 2%; padding-right: 10%; padding-left: 3%;" >
		<div class="row">
			<div class="col-md-3">
				<div style="padding-top: 2%; padding-bottom: 2%;  padding-left: 10%">
				<ul style="padding-top: 2%; padding-bottom: 2%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="REditChairman.php?action=view&p_id=<?php echo $row['p_id']?>" style="color:white;">Edit Chairman</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">

      			</li>
				</div>
			</div>
			<div class="col-md-9" style=" padding-left: 2%; padding-top: 3%; padding-bottom: 3%;">
				<div style="padding-top: 3%; padding-bottom: 3%;  padding-left: 36%; ">
				<h1>Property</h1>
				</div>
				<div style="padding-top: 3%; padding-bottom: 2%; padding-left: 6%; ">
				<div class="container">
				<div class="row">	
							<div class="col-md-4">
								<h4>Name:</h4><p><?php echo $row['name']; ?></p>
							</div>
							<div class="col-md-4">
								<h4>Location:</h4><p><?php echo $row['location']; ?></p>
							</div>
							<div class="col-md-4">
								<h4>Type:</h4><p><?php echo $row['type']; ?></p>
							</div>
							<div class="col-md-4">
								<h4>Caretaker:</h4><p><?php echo $row['incharge']; ?></p>
							</div>
							<div class="col-md-4">
								<h4>Number Of Houses:</h4><p><?php echo $row['numofhouses']; ?></p>
							</div>
							<div class="col-md-4">
								<h4>Chairman:</h4><p><?php echo $row['chair']; ?></p>
							</div>
			</div>
			</div>
		</div>
			</div>
		    
		</div>
	</div>
<?php 
	}
}
 ?>