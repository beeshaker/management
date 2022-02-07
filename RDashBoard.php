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
    		<div class="col-md-3" style="background-color: #FFFFFF">
      		<!-- Content -->
      		<ul style="padding-top: 2%; padding-bottom: 2%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AssignComplaints.php" style="color:white;">Assign Service Request</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewCustomer.php" style="color:white;">Add New Customer</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewEmployee.php" style="color:white;">Add New Employee</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="AddNewProperty.php" style="color:white;">Add New Property</a></button>
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="RPropertyHome.php" style="color:white;">View Property</a></button>
      			</li>
      			
      			</li>
      			<li style="padding-top: 2%; padding-bottom: 2%;">
      				<button type="button" class="btn btn-dark btn-block"><a href="RPropertyHome.php" style="color:white;">Tenacy Lease Management</a></button>
      			</li>
			</ul>
		    </div>
    		<div class="col-md-9" style="padding-right: 2%; padding-left: 5%;">
      		<!-- Content -->
      			<div style="padding-top: 3%; padding-bottom: 2%; text-align: center;">
					<h1>DashBoard</h1>
				</div>
				<div style="padding-top: 3%; padding-bottom: 2%;text-align: center;padding-right: 2%; padding-left: 2%;">
				</div>
				<?php
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
				    	 $user = $row['l_id'];
				    	// echo $cid;
				    	// echo $pid;
				    	}
					}
				$Username = $_COOKIE["user"];
				$sql = "SELECT count(complaints.`c_id`)as counted from complaints where complaints.`type` = '0' and status = 'incomplete'";
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
	      		<div class="card-group">
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">Unassigned Service Requests</h4></center>
					      <h1 style="text-align: center;"><strong><?php echo $row['counted']; }}?></strong></h1>
					    </div>
					</div>
					<?php
					$sql = "SELECT count(complaints.`c_id`)as counted from complaints where complaints.`type` <> '0';";
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
					<div class="card">
					    <div class="card-body">
					      <center><h4 class="card-title">Assigned Service Requests</h4></center>
					      <h1 style="text-align: center;"><strong><?php echo $row['counted']; }}?></strong></h1>
					    </div>
					</div>
				</div>
    		</div>
		</div>
	</div>
</body>
</html>