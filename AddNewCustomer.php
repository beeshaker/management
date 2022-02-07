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
	$semail = ($_POST['semail']);
	$password = ($_POST['pass']);
	$hashedpass = password_hash($password, PASSWORD_DEFAULT);
	$phone = ($_POST['phone']);
	$sphone = ($_POST['sphone']);
	$unit = ($_POST['unum']);
	$pid = ($_POST['property']);
	$owner = ($_POST['ctype']);
	$sql = "INSERT INTO customer(fname,lname,email,semail,password,sphone,phone,unum,pid,owner) VALUES('$fname','$lname','$email','$semail','$hashedpass','$sphone','$phone','$unit','$pid','$owner')";
	  	if($conn->query($sql) === true)
	  	{
	  		$sql1 = "INSERT INTO login(email,password,type) VALUES('$email','$hashedpass','customer')";
	  		if($conn->query($sql1) === true)
	  		{
	  			//email configuration start---------------------------------------------------------------------
				$email_from = 'noreply@apricot.ke';//<== update the email address
				$email_subject = "Welecome To Apricot Property Solutions Ltd. ";
				$email_body = "Welcome to Apricot Property Solutions Ltd. \n 
                               Here are your credentials to our property management portal:\n 
                               Login website address: www.management.apricot.ke\n 
                               Email: '$email'\n 
                               Password: '$password' \n
                               Please use this portal for you to register any requests, service requirements or complaints that you may have.\n \n
                               <\br><img src=\"https://management.apricot.ke/images/Capture.JPG\"><\br>'";
				$to = "$email"; //<== update the email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//end of email configuration---------------------------------------------------------------------
			//Start of mail function ------------------------------------------------------------------------
				if(mail($to,$email_subject,$email_body,$headers))
				{
					echo '<script>alert("Message is Sent Succesfully")</script>';
					echo '<script>window.location="RDashBoard.php"</script>';
					
					$name = $email = $message = '';
				}
				else
				{
					echo '<script>alert("Error Ocurred When Sending the Message. Please Try Again")</script>';
					echo '<script>window.location="RDashBoard.php"</script>';
				} 
			//end of mail function --------------------------------------------------------------------------
	  			//echo '<script>alert("Customer has been added")</script>';
				//echo '<script>window.location="RDashBoard.php"</script>';

	  		}
		}
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
		<h1>New Client</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="AddNewCustomer.php" method="POST" enctype="multipart/form-data">
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
					<label for="formGroupExampleInput2">Client Type:</label>
					<select class="form-control" id="sel1" name="ctype">
						<option value="Owner">Owner</option>
					    <option value="Tenant">Tenant</option>
					</select>
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
				    <label for="formGroupExampleInput2">Secondary Email</label>
				    <input type="email" class="form-control" id="formGroupExampleInput2" placeholder="Email address" name="semail">
				</div>
		    </div>		    
		    <div class="col-md-6">
		     	<div class="form-group">
			  	<label for="formGroupExampleInput2">Property</label>
			  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Property Name" required="" list="propertys" name="property">
			  	<datalist id="propertys">
			    <?php
			    $display = "SELECT * from property ;";
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
			    <option value="<?php echo $row['p_id']; ?>"><?php echo $row['p_id']; ?> | Name: <?php echo $row['name']; ?></option>
			        <?php
			                  }
			                } 
			        ?>
			  	</datalist>
				</div>
		    </div>
		    <div class="col-md-6">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Unit Number</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Unit Number" name="unum" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Phone Number</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="phone" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Secondary Phone Number</label>
				    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Phone Number" name="sphone" required="">
				</div>
		    </div>
		    <div class="col-md-4">
		   		<div class="form-group">
				    <label for="formGroupExampleInput2">Password</label>
				    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Password" name="pass" required="">
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