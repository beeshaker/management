<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];

if(isset($_POST["view"]))
{
	$sql = "SELECT l_id FROM login WHERE email ='$Username'";
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
    	 $incharge = $row['l_id'];
    	// echo $cid;
    	// echo $pid;
    	}
	}
}
	$p_id = $_GET["p_id"];

	$sql = "SELECT * FROM property WHERE property.p_id = '$p_id';";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{

    }
    else
    {
    	while($row = $result->fetch_assoc()) {



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
<div style="padding-top: 2%; padding-bottom: 2%; padding-right: 10%; padding-left: 3%;" >
	<div class="row">
		<div class="col-md-3">
				<div style="padding-top: 2%; padding-bottom: 2%;  padding-left: 10%">
				<ul style="padding-top: 2%; padding-bottom: 2%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      			</li>
				</div>
		</div>
		<div class="col-md-9" style=" padding-left: 2%; padding-top: 3%; padding-bottom: 3%;">
			<div style="padding-top: 3%; padding-bottom: 3%;  padding-left: 36%; ">
				<h1>Edit Chairman</h1>
			</div>
			<div style="padding-top: 3%; padding-bottom: 2%; padding-left: 6%; ">
				<div class="container">
					<div class="row">	
						<div class="col-md-4">
				      		<form action="REdit.php" method="POST">
				   				<div class="form-group">
				   					<input type="hidden" name="p_id" value="<?php echo $row['p_id']; }} ?>">
						    		<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="New Chairman" name="chair" required="">
								</div>
						</div>
						<div class="col-md-2">
				   			<div class="form-group">
						    	<input type="submit" class="btn btn-dark btn-block" value="Save">
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	