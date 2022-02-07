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
	$sql = "SELECT * FROM customer inner join property on customer.pid=property.p_id where email = '$Username';";
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
		<!--JQuery-->  

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
					<h1>New Service Request</h1>
				</div>
					<div class="container">
					<div class="row">
					    <div class="col-md-4">
					      <form action="ClientComp.php" method="POST" enctype="multipart/form-data">
					     	<div class="form-group">
						  	<label for="formGroupExampleInput2">Client Name</label>
						  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Client Name" required="" list="customers" name="" value="<?php echo $row['fname']; echo (" "); echo $row['lname']; ?>" readonly="">
						  	<input type="hidden" name="customers" value="<?php echo $row['u_id']; ?>">
							</div>
					    </div>
					    <div class="col-md-4">
					   		<div class="form-group">
							    <label for="formGroupExampleInput2">Unit Number</label>
							    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Unit Number" name="" required="" value="<?php echo $row['unum']; ?>" readonly="">
							</div>
					    </div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="formGroupExampleInput2">Client Type:</label>
								<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Client Type" name="" required="" value="<?php echo $row['owner']; ?>" readonly="">
							</div>
						</div>
					    <div class="col-md-4">
					     	<div class="form-group">
							  	<label for="formGroupExampleInput2">Property</label>
							  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Property Name" required="" list="propertys" name="" value="<?php echo $row['name']; ?> " readonly="">
							  	<input type="hidden" name="property" value="<?php echo $row['p_id']; }} ?>">
							</div>
					    </div>
					    <div class="col-md-4">
					    	<div class="form-group">
						    <label for="formGroupExampleInput2">Title of the request</label>
						    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Title of the request" name="issue" required="">
						  	</div>
					    </div>
					    <div class="col-md-4">
					    	<div class="form-group">
						    	<label for="formGroupExampleInput2">Date of Entry</label>
						    	<input type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="dateofentry" readonly/>
							</div>
						</div> 
					    <div class="col-md-12">
					  		<div class="form-group">
					    	<label for="formGroupExampleInput2">Description of the request</label>
					    		<div class="container">
					    		<div class="comment">
					    		<textarea class="textinput" placeholder="Enter the issue description" name="desc"></textarea>
					  			</div>
							</div>
					  		</div>
					    </div>
						<div class="col-md-4">
						    <div class="form-group">
							    <label for="formGroupExampleInput2">File Upload</label>
							    <input type="file" name="Filename" />
							</div>
						</div>
						<div class="col-md-4">
					    	<div class="form-group">
						    <!--<label for="formGroupExampleInput2">Status</label>-->
						    <input type="hidden" value="Incomplete" class="form-control" name="status" readonly/>
							</div>
						</div>	
						<div class="col-md-4">
						    <div class="form-group">
							    <!--<label for="formGroupExampleInput2">Authorization Status</label>-->
							    <input type="hidden" value="Pending" class="form-control" name="authorize" readonly/>
							</div>
						</div>
					</div>
					</div>	  
					<div class="form-group" style="padding-top: 1%; padding-bottom: 2%; padding-right: 60%; padding-left: 2%">
					    <label for="formGroupExampleInput2"></label>
					    <input type="submit" class="btn btn-dark btn-block" value="Submit">
					</div>
					</form>
			</div>
		</div>
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