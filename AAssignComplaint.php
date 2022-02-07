<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
//confirming if the customer exists ------------------------------------------------------------------------------
$incharge = "";
if(isset($_POST["update"]))
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

    	}
	}
}

	$c_id = $_GET["c_id"];
	$client_id = $_GET["client_id"];

	$sql = "SELECT complaints.client_id,customer.fname,customer.lname,complaints.issue,complaints.issuedesc,property.name,complaints.startdate,complaints.priority,complaints.`status`,complaints.`type`,customer.unum,customer.owner,complaints.image,complaints.solution,complaints.cost,complaints.enddate,complaints.c_id,complaints.incharge,complaints.authorizer from complaints  
							inner join property on complaints.p_id = property.p_id
							inner join customer on complaints.client_id = customer.u_id
							where complaints.client_id = '$client_id'
							and complaints.`status` = 'incomplete'
							and complaints.c_id = '$c_id';";
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
		<h1>Assign Complaint</h1>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-4">
		<form action="AAssign.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="complaintid" value="<?php echo $row['c_id']?>">
		<input type="hidden" name="clientid" value="<?php echo $row['client_id']?>">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Client Name</label>
		    <input type="text" class="form-control" value = "<?php echo $row['fname']?> <?php echo $row['lname']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
		   	<div class="form-group">
				<label for="formGroupExampleInput2">Unit Number</label>
				 <input type="text" class="form-control" id="formGroupExampleInput2" value = "<?php echo $row['unum']?>"placeholder="Client Name" name="cnum" required="" readonly>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				 <label for="formGroupExampleInput2">Client Type</label>
				 <input type="text" class="form-control" id="formGroupExampleInput2" value = "<?php echo $row['owner']?>"placeholder="Client Name" name="cnum" required="" readonly>
			</div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Property Name</label>
		    <input type="text" class="form-control" value = "<?php echo $row['name']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Title of the issue</label>
		    <input type="text" class="form-control"  value = "<?php echo $row['issue']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Date of Entry</label>
		    <input type="Date" class="form-control" value = "<?php echo $row['startdate']?>"id="formGroupExampleInput2" placeholder="Date of Entry" name="dateofentry" required="Enter the students Date of Birth" readonly>
		  </div>
		</div>
		<div class="col-md-12">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Description of the issue</label>
		    <textarea class="form-control" name="desc" required="" readonly=""><?php echo $row['issuedesc']?></textarea>
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="formGroupExampleInput2">Priority</label>
				<select class="form-control" id="sel1" name="priority">
					<option value="High">High</option>
					<option value="Medium">Medium</option>
					<option value="Low">Low</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Status</label>
		    <input type="text" class="form-control" value = "<?php echo $row['status']?> "id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="formGroupExampleInput2">Type</label>
				<select class="form-control" id="sel1" name="type">
				   	<option value="Operational">Operational</option>
				    <option value="Equipment">Equipment</option>
				    <option value="Decsion Making">Decsion Making</option>
				    <option value="Owner Issues">Owner Issues</option>
				</select>
			</div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Authorization Status</label>
		    <input type="text" class="form-control" value = "<?php echo $row['authorizer']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="formGroupExampleInput2">Assigned to:</label>
				<select class="form-control" id="sel1" name="assign">
					    <?php
					    $display = "SELECT * from employees where type = 'emp' ;";
					                $result = $conn->query($display);
					                if($result->num_rows == 0)
					                {
					                  echo "nope";
					                }
					                else
					                {
					                  while($row = $result->fetch_assoc()) 
					                  {
					    ?>
					    <option value= "<?php  echo $row['e_id']; ?>">ID:<?php echo $row['e_id']; ?> | Name: <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></option>
					        <?php
					                  }
					                } 
					        ?>
				</select>
			</div>
		</div>
		 	<?php
		}
	}

	?>
	</div>
	</div> 
		<div class="form-group" style="padding-top: 1%; padding-bottom: 2%; padding-right: 60%; padding-left: 2%">
		    <label for="formGroupExampleInput2"></label>
		    <input type="submit" class="btn btn-dark btn-block" value="Save">
		</form>
</body>
</html>
