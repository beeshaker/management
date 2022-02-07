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
if(isset($_POST["view"]))
{
	$sql = "SELECT u_id FROM customer WHERE email ='$Username'";
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
	$c_id = $_GET["c_id"];
	$client_id = $_GET["client_id"];
	$sql = "SELECT complaints.client_id,customer.fname,customer.lname,complaints.issue,complaints.issuedesc,property.name,complaints.startdate,complaints.priority,complaints.`status`,complaints.`type`,customer.unum,customer.owner,complaints.image,complaints.solution,complaints.cost,complaints.enddate,a.fname as ifname,a.lname as ilname,complaints.c_id,complaints.incharge,complaints.authorizer from complaints 
							inner join property on complaints.p_id = property.p_id
							inner join employees a on complaints.incharge = a.e_id
							inner join customer on complaints.client_id = customer.u_id
							where complaints.client_id = '$client_id'
							and complaints.c_id = '$c_id';";
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
	    <!--JQuery-->  
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  
<!--Floating WhatsApp css-->  
<link rel="stylesheet" href="Whatsapp/floating-wpp.min.css">  
<!--Floating WhatsApp javascript-->  
<script type="text/javascript" src="Whatsapp/floating-wpp.min.js"></script>
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
		<h1>View Complaint</h1>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-4">
		<form action="ViewComplaint.php" method="POST">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Client Name</label>
		    <input type="text" class="form-control" value = "<?php echo $row['fname']?><?php echo $row['lname']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
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
				<div class="form-group">
				    <label for="formGroupExampleInput2">Client Type</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" value = "<?php echo $row['owner']?>"placeholder="Client Name" name="cnum" required="" readonly>
				</div>
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
			    <div class="container">
			    	<div class="comment">
			    		<textarea class="textinput" placeholder="Enter the issue description" name="solve" readonly=""><?php echo $row['issuedesc']?></textarea>
			  		</div>
				</div>
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
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Date of Entry</label>
		    <input type="Date" class="form-control" value = "<?php echo $row['startdate']?>"id="formGroupExampleInput2" placeholder="Date of Entry" name="dateofentry" required="Enter the students Date of Birth" readonly>
		  </div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Date of Completion</label>
		    <input type="Date" class="form-control" value = "<?php echo $row['enddate']?>"id="formGroupExampleInput2" placeholder="Date of Entry" name="dateofentry" required="Enter the students Date of Birth" readonly>
		  </div>
		</div>				
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Priority</label>
		    <input type="text" class="form-control" value = "<?php echo $row['priority']?> "id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
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
		    <input type="text" class="form-control"  value = "<?php echo $row['type']?> "id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-4">
		  <div class="form-group">
		    <label for="formGroupExampleInput2">Assigned to:</label>
		    <input type="text" class="form-control"  value = "<?php echo $row['ifname']?> <?php echo $row['ilname']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
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
		    <label for="formGroupExampleInput2">Cost Inccurred</label>
		    <input type="text" class="form-control" value = "<?php echo $row['cost']?>"id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="" readonly>
		  </div>
		</div>
		<div class="col-md-12">
			<label for="formGroupExampleInput2">Uploaded Image</label>
			<img src="<?php echo $row['image']?>" style="width: 100%; height: 100%">	
		</div>

		 	<?php
		}
	}
	?>  
		</form>
	</div>
	<!--Div where the WhatsApp will be rendered-->  
    <div id="WAButton"></div>  

</body>
<script type="text/javascript">  
   $(function () {
           $('#WAButton').floatingWhatsApp({
               phone: '254755452444', //WhatsApp Business phone number
               headerTitle: 'Chat with us on WhatsApp!', //Popup Title
               popupMessage: 'Hello, how can we help you?', //Popup Message
               showPopup: true, //Enables popup display
               buttonImage: '<img src="Whatsapp/whatsapp.svg" />', //Button Image
               //headerColor: 'crimson', //Custom header color
               //backgroundColor: 'crimson', //Custom background button color
               position: "right" //Position: left | right

           });
       });
</script>  
</html>