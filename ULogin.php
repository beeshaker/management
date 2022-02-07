<?php
require 'db.php';
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$email = $conn->real_escape_string($_POST['username']);
	$password = ($_POST['password']);
// start query ----------------------------------------------------------------------------------------
	$sql="SELECT * FROM employees WHERE username ='$email'";
	$result = $conn->query($sql);
//end queary-------------------------------------------------------------------------------------------
		if(($result->num_rows == 0)){
		echo '<script>alert("The email or password is incorrect")</script>';
		echo '<script>window.location="Login.php"</script>';
	}
	else
	{
		while(($row = $result->fetch_assoc())) {
			$type = $row['type'];
			if(($type == "emp"))
			{
			    if(password_verify($password, $row['password']) == true){
			        //$_SESSION['email']=$email;
				    setcookie("user",$row['username'],time()+86400);
			    	echo '<script>alert("Welcome")</script>';
			    	echo '<script>window.location="CDashBoard.php"</script>';
			    }
			    else {
			       
			        echo '<script>alert("The email or password is incorrect")</script>';
			    }
				
			}
			else if($type == "customer"){
			    if(password_verify($password, $row['password']) == true) {
			        //$_SESSION['email']=$email;
				    setcookie("user",$row['email'],time()+86400);
				    echo '<script>alert("Welcome Customer")</script>';
				    echo '<script>window.location="ClientDashBoard.php"</script>';
			    }
			    else {
			       
			        echo '<script>alert("The email or password is incorrect")</script>';
			    }
				
			}
			else if($type == "senior"){
			//	$_SESSION['email']=$email;
				if(password_verify($password, $row['password']) == true){
			        //$_SESSION['email']=$email;
				    setcookie("user",$row['email'],time()+86400);
				    echo '<script>alert("Welcome")</script>';
				    echo '<script>window.location="ADashBoard.php"</script>';
			        
			    }
			    else {
			       
			        echo '<script>alert("The email or password is incorrect here")</script>';
			    }
			}
			
			else if($type == "reception"){
			//	$_SESSION['email']=$email;
				if(password_verify($password, $row['password']) == true){
			        //$_SESSION['email']=$email;
				    setcookie("user",$row['email'],time()+86400);
				    echo '<script>alert("Welcome")</script>';
				    echo '<script>window.location="RDashBoard.php"</script>';
			        
			    }
			    else {
			       
			        echo '<script>alert("The email or password is incorrect here")</script>';
			    }
			}
			else
			{
			    if(password_verify($password, $row['password']) == true){
			        //$_SESSION['email']=$email;
				    setcookie("user",$row['email'],time()+86400);
				    echo '<script>alert("Welcome")</script>';
				    echo '<script>window.location="ADashBoard.php"</script>';
			        
			    }
			    else {
			       
			        echo '<script>alert("The email or password is incorrect")</script>';
			    }
				
			}
		}
	}
}
//end form action---------------------------------------------------------------------------------------
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
			<h1>Login</h1>
		</div>
		<div style="padding-top: 3%; padding-bottom: 2%; padding-right: 0%; padding-left: 35%">
			<div class="row">
				<div class="col-md-6">
					<form method="POST" action="ULogin.php">
		  				<div class="form-group">
		    				<label for="formGroupExampleInput">Username</label>
		    				<input type="text" class="form-control" id="formGroupExampleInput" placeholder="Email"name="username">
		 				 </div>
		  				<div class="form-group">
		    				<label for="formGroupExampleInput2">Password</label>
		    				<input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="password">
		  				</div>
		  				<button type="submit" class="btn btn-dark">Submit</button>
					</form>
					<br><br>
					<center><a href="Login.php" style="color: black;">Login With Email.</a></center>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		
	</script>
</body>
</html>