<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
if($_SERVER['REQUEST_METHOD']==='POST')
{
		$fname = ($_POST['fname']);
		$lname = ($_POST['lname']);
		$email = ($_POST['email']);
		$password = ($_POST['pass']);
		$hashedpass = password_hash($password, PASSWORD_DEFAULT);
		$phone = ($_POST['phone']);
		$type = ($_POST['type']);
		$username = ($_POST['username']);

	  	$sql = "INSERT INTO employees(fname,lname,email,password,phone,type,username) VALUES('$fname','$lname','$email','$hashedpass','$phone','$type','$username')";
	  	if($conn->query($sql) === true)
	  	{
	  		$sql1 = "INSERT INTO login(email,password,type) VALUES('$email','$hashedpass','$type')";
	  		if($conn->query($sql1) === true)
	  		{
	  			echo '<script>alert("Employee has been added")</script>';
				echo '<script>window.location="RDashBoard.php"</script>';
	  		}
		}
}
else
{
 //echo "nope";
}
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
	<div style="padding-top: 3%; padding-bottom: 2%; padding-right: 5%; padding-left: 5%">
		<div class="row">
		<div class="col-md-2" style="background-color: #FFFFFF">
			<ul style="padding-top: 1%; padding-bottom: 1%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      			</li>
      		</ul>
		</div>
		<div class="col-md-10" style="padding-right: 2%; padding-left: 5%;">
	<div style="padding-top: 5%; padding-bottom: 2%; padding-right: 10%; padding-left: 40%">
		<h1>New Employee</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="AddNewEmployee.php" method="POST" enctype="multipart/form-data">
		     	<div class="form-group">
			  	<label for="formGroupExampleInput2">First Name</label>
			  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="First Name" required="" name="fname">
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Last Name</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Last Name" name="lname" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Email</label>
				    <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="Email address" name="email" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Password</label>
				    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="pass" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Username</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="UserName" name="username" required="">
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Phone Number</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="phone" required="">
				</div>
		    </div>
		    <div class="col-md-6">
				<div class="form-group">
				  <label for="formGroupExampleInput2">Type</label>
				  <select class="form-control" id="sel1" name="type">
				   	<option value="emp">Employee</option>
				    <option value="senior">Senior Management</option>
				    <option value="reception">reception</option>
				  </select>
				</div>
		    </div>
		    <div class="col-md-4">
				<div class="form-group" style="padding-top: 1%; padding-bottom: 2%; padding-right: 60%; padding-left: 2%">
		    		<label for="formGroupExampleInput2"></label>
		    		<input type="submit" class="btn btn-dark btn-block" value="Submit">
				</div>
			</div>
		</form>
	</div>
	</body>
	</html>