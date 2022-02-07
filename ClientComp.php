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
			echo "error";
		}

	//file upload -------------------------------------------------------------------------------------------------
		$client = ($_POST['customers']);
		$property = ($_POST['property']);
		$dateofentry = ($_POST['dateofentry']);
		$issue = $conn->escape_string($_POST['issue']);
		$desc = $conn->escape_string($_POST['desc']);
		$status = ($_POST['status']);
		$authorize =($_POST['authorize']);
  

	  	$sql = "INSERT INTO complaints(image,client_id,issuedesc,issue,authorizer,status,startdate,p_id) VALUES('$filetarget','$client','$desc','$issue','$authorize','$status','$dateofentry','$property')";
	  	if($conn->query($sql) === true)
	  	{

		  	$userassign = "SELECT email from customer where email = '$Username'";
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

						 //echo $row['email'] ; 
						echo $client;
						 $sendemail = $row['email'];

		   //email configuration start---------------------------------------------------------------------
				$email_from = 'noreply@apricot.ke';//<== update the email address
				$email_subject = "New Service Request";
				$email_body ="Your request has been recorded you will recieve an email within 24hrs with the details of the employee that is assigned to attend to your request.\r\n\n Thank You.\n
				'\n\n<img src=\"https://management.apricot.ke/images/Capture.JPG\">\n\n'";
				$to = "$sendemail"; }}//<== update the email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//end of email configuration---------------------------------------------------------------------
			//Start of mail function ------------------------------------------------------------------------
				if(mail($to,$email_subject,$email_body,$headers))
				{
					echo '<script>alert("Message is Sent Succesfully")</script>';
					echo '<script>window.location="ClientDashBoard.php"</script>';
					
					$name = $email = $message = '';
				}
				else
				{
					echo '<script>alert("Error Ocurred When Sending the Message. Please Try Again")</script>';
					echo '<script>window.location="ClientDashBoard.php"</script>';
				} 
			//end of mail function --------------------------------------------------------------------------
		}
}
else
{
 //echo "nope";
}
?>