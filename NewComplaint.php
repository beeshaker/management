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
	//file upload--------------------------------------------------------------------------------------------------
	$fileexistsflag = 0;
	$filename = $_FILES["Filename"]['name'];

	$target = "images/";
	$filetarget = $target.$filename;
	$tempfilename = $_FILES["Filename"]["tmp_name"];
	$size = $_FILES["Filename"]['size'];
	$result = move_uploaded_file($tempfilename, $filetarget);

		if($result)
		{
			//echo $filetarget;
		}
		else
		{
			//echo "error";
		}

	//file upload -------------------------------------------------------------------------------------------------
		$client = ($_POST['customers']);
		$property = ($_POST['property']);
		echo $client;
		$dateofentry = ($_POST['dateofentry']);
		$issue = $conn->escape_string($_POST['issue']);
		$desc = $conn->escape_string($_POST['desc']);
		$priority =($_POST['priority']);
		$status = ($_POST['status']);
		$type =($_POST['type']);
		$assign = ($_POST['assign']);
		$authorize =($_POST['authorize']);
  

	  	$sql = "INSERT INTO complaints(image,client_id,issuedesc,issue,incharge,authorizer,status,startdate,type,priority,p_id) VALUES('$filetarget','$client','$desc','$issue','$assign','$authorize','$status','$dateofentry','$type','$priority','$property')";
	  	if($conn->query($sql) === true)
	  	{

		  	$userassign = " SELECT email from employees where e_id = '$assign'";
		  	//echo $userassign;
		  	$result = $conn->query($userassign);
			if($result->num_rows == 0)
				{
					echo "nope";
			    }
			else
				{
					while($row = $result->fetch_assoc()) 
					{		
						//echo $client;
						// echo $row['email'] ; 
						 $sendemail = $row['email'];

		   //email configuration start---------------------------------------------------------------------
				$email_from = 'noreply@apricot.ke';//<== update the email address
				$email_subject = "New Form submission";
				$email_body = "You have been assigned a new issue Login to the system.\n
				'\n\n<img src=\"https://management.apricot.ke/images/Capture.JPG\">\n\n'";
				$to = "$sendemail"; }}//<== update the email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//end of email configuration---------------------------------------------------------------------
			//Start of mail function ------------------------------------------------------------------------
				if(mail($to,$email_subject,$email_body,$headers))
				{
					echo '<script>alert("Message is Sent Succesfully")</script>';
					echo '<script>window.location="CDashBoard.php"</script>';
					
					$name = $email = $message = '';
				}
				else
				{
					echo '<script>alert("Error Ocurred When Sending the Message. Please Try Again")</script>';
					echo '<script>window.location="CDashBoard.php"</script>';
				} 
			//end of mail function --------------------------------------------------------------------------
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
		<h1>New Complaint</h1>
	</div>
		<div class="container">
		<div class="row">
		    <div class="col-md-6">
		      <form action="NewComplaint.php" method="POST" enctype="multipart/form-data">
		     	<div class="form-group">
			  	<label for="formGroupExampleInput2">Client Name</label>
			  	<input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Client Name" required="" list="customers" name="customers">
			  	<datalist id="customers">
			    <?php
			    $display = "SELECT * from customer ;";
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
			    <option value="<?php echo $row['u_id']; ?>">ID:<?php echo $row['u_id']; ?> | Name: <?php echo $row['fname']; ?> <?php echo $row['lname']; ?></option>
			        <?php
			                  }
			                } 
			        ?>
			  	</datalist>
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
			    <label for="formGroupExampleInput2">Title of the issue</label>
			    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Title of the Issue" name="issue" required="">
			  	</div>
		    </div>
		    <div class="col-md-6">
		    <div class="form-group">
			    <label for="formGroupExampleInput2">Date of Entry</label>
			    <input type="text" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="dateofentry" readonly/>
			</div>
			</div> 
		    <div class="col-md-12">
		  		<div class="form-group">
		    	<label for="formGroupExampleInput2">Description of the issue</label>
		    		<div class="container">
		    		<div class="comment">
		    		<textarea class="textinput" placeholder="Enter the issue description" name="desc"></textarea>
		  			</div>
				</div>
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
			    <input type="text" value="Incomplete" class="form-control" name="status" readonly/>
				</div>
			</div>	
			<div class="col-md-4">
				<div class="form-group">
				  <label for="formGroupExampleInput2">Type</label>
				  <select class="form-control" id="sel1" name="type">
				   	<option value="Operational">Operational</option>
				    <option value="Accounts">Accounts</option>
				  </select>
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
			<div class="col-md-4">
			    <div class="form-group">
				    <label for="formGroupExampleInput2">Authorization Status</label>
				    <input type="text" value="Pending" class="form-control" name="authorize" readonly/>
				</div>
			</div>
			<div class="col-md-4">
			    <div class="form-group">
				    <label for="formGroupExampleInput2">File Upload</label>
				    <input type="file" name="Filename" />
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
	</body>
	</html>