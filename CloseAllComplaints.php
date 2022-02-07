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
	<div style="padding-top: 5%; padding-bottom: 2%; padding-right: 10%; padding-left: 36%">
		<h1>Close Complaints</h1>
	</div>
		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th>#</th>
		      <th>Client Name</th>
		      <th>Issue Title</th>
		      <th>Property Name</th>
		      <th>View</th>
		    </tr>
		  </thead>
		  <?php
						$sql = "SELECT username FROM employees WHERE email = '$Username' or username = '$Username'";
							$result = $conn->query($sql);
							if($result->num_rows == 0)
							{
								echo '<script>alert("The user does not exist. Please login. ")</script>';
								echo '<script>window.location="Login.php"</script>';
						    }
						    else{
						    
						    	 while($row = $result->fetch_assoc()) {
						    	 $incharge = $row['username'];
						    	// echo $cid;
						    	// echo $pid;
						    }
						}
						//to be changed //query to dispaly product details -------------------------
						$display = "SELECT complaints.client_id,customer.fname,customer.lname,complaints.issue,property.name,complaints.c_id,complaints.incharge from complaints 
							inner join property on complaints.p_id = property.p_id
							inner join employees on complaints.incharge = employees.e_id
							inner join customer on complaints.client_id = customer.u_id
							where complaints.incharge = (select e_id from employees where username = '$incharge')
							and complaints.`status` = 'incomplete';";
							$result = $conn->query($display);

						//query to display product details ------------------------------------------

							if($result->num_rows == 0)
							{
							//echo $cid;
							//echo "nope";
    						}
    						else
    						{
    	 					while($row = $result->fetch_assoc()) 
    	 					{

    	 					//insert into table --------------------------------------------------------------------------
    	 					?>
		  <tbody>
		    <tr>
		      <th scope="row"><?php echo $row['c_id']; ?></th>
		      <td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></td>
		      <td><?php echo $row['issue']; ?></td>
		      <td><?php echo $row['name']; ?></td>
		      <td><button type="button" name = "view"class="btn btn-dark"><a href="CloseComplaint.php?action=close&c_id=<?php echo $row['c_id']?>&e_id=<?php echo $row['incharge']?>" style="color:white;">CLOSE</a></button></td>
		    </tr>
		    		<?php

		    			}
						}
					?>
		  </tbody>
		</table>
	</div>