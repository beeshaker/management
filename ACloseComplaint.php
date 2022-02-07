<?php
session_start();
require 'db.php';
//----check whether user is logged in
if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
//confirming if the customer exists --------------------
$incharge = "";
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
//confirming if the customer exists --------------------
// get the complaint from the db -----------------------
	$c_id = $_GET["c_id"];
	$e_id = $_GET["e_id"];
	$sql = "SELECT complaints.client_id,customer.fname,customer.lname,complaints.issue,complaints.issuedesc,property.name,complaints.startdate,complaints.priority,complaints.`status`,complaints.`type`,customer.unum,customer.owner,complaints.image,complaints.solution,complaints.cost,complaints.enddate,a.fname as ifname,a.lname as ilname,complaints.c_id,complaints.incharge,complaints.authorizer from complaints 
							inner join property on complaints.p_id = property.p_id
							inner join employees a on complaints.incharge = a.e_id
							inner join customer on complaints.client_id = customer.u_id
							where complaints.`status` = 'Complete'
							and complaints.c_id = '$c_id';";
	$result = $conn->query($sql);
	if($result->num_rows == 0)
	{
		//echo '<script>alert("No complaints")</script>';
		//echo '<script>window.location="Login.php"</script>';
    }
    else
    {
    	//echo '<script>alert("There are complaints ")</script>';
		//echo '<script>window.location="login.php"</script>';
    	while($row = $result->fetch_assoc()) {
    	//$incharge = $row['u_id'];
    	// echo $cid;
    	// echo $pid;
 // get the complaint from the db -----------------------  
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
		<h1>Close Complaint</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<form action="AClose.php" method="POST" name="update" role="form">
				<input type="hidden" name="cid" value="<?php echo $row['c_id']?>">
			  	<div class="form-group">
			    	<label for="formGroupExampleInput2">Client Name</label>
			    	<input type="text" class="form-control" value = "<?php echo $row['fname']?> <?php echo $row['lname']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
			  	</div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
			    <label for="formGroupExampleInput2">Property Name</label>
			    <input type="text" class="form-control" value = "<?php echo $row['name']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
			  </div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
			    <label for="formGroupExampleInput2">Title of the issue</label>
			    <input type="text" class="form-control"  value = "<?php echo $row['issue']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
			  </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group">
				    <label for="formGroupExampleInput2">Date of Entry</label>
				    <input type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="dateofentry" readonly/>
				</div>
			</div>
			<div class="col-md-12">
			  <div class="form-group">
			    <label for="formGroupExampleInput2">Description of the issue</label>
			    <input type="text" class="form-control"  value = "<?php echo $row['issuedesc']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly="">
			  </div>
			</div>
			<div class="col-md-12">
			  	<div class="form-group">
			    	<label for="formGroupExampleInput2">Solution of the issue</label>
			    		<div class="container">
			    		<div class="comment">
			    		<textarea class="textinput" placeholder="Enter the issue description" name="solve" readonly=""><?php echo $row['solution']?></textarea>
			  			</div>
					</div>
			  		</div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
			    <label for="formGroupExampleInput2">Cost Incurred</label>
			    <input type="text" class="form-control"  value = "<?php echo $row['cost']?>"id="formGroupExampleInput2" placeholder="Cost Incurred In Kshs." name="cost" required="" readonly >
			  </div>
			</div>
			<div class="col-md-3">
			    <div class="form-group">
				    <label for="formGroupExampleInput2">Date of Completion</label>
				    <input type="text" value="<?php echo $row['enddate']?>" class="form-control" name="dateofentry2" readonly/>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				  <label for="formGroupExampleInput2">Authorization Status</label>
				  <select class="form-control" id="sel1" name="authorize">
				   	<option value="Pending">Pending</option>
				   	<option value="Authorized">Authorized</option>
				  </select>
				</div>	 
			</div> 
			<div class="col-md-3">
				<div class="form-group">
					<label for="formGroupExampleInput2">Status</label>
					<select class="form-control" id="sel1" name="status">
						<option value="Complete">Complete</option>
						<option value="Incomplete">Incomplete</option>
						<option value="Archive">Archive</option>
					</select>
				</div>
			</div>
			<div class="col-md-12">
			  	<div class="form-group">
			    	<label for="formGroupExampleInput2">Remarks</label>
			    		<div class="container">
			    		<div class="comment">
			    		<textarea class="textinput" placeholder="Enter your remarks" name="remark"></textarea>
			  			</div>
					</div>
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
		    <input type="submit" class="btn btn-dark btn-block" value="Close">
		</form>
	</body>
	</html>
