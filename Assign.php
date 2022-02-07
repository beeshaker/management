<?php
session_start();
require 'db.php';
if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
//---------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------
if($_SERVER['REQUEST_METHOD']==='POST')
{
  $type = $conn->escape_string($_POST['type']);
  $priority =($_POST['priority']);
  $assign = ($_POST['assign']);
  $complaintid = ($_POST['complaintid']);
  $clientid = ($_POST['clientid']);
  $updatequery = "UPDATE complaints set type = '$type',priority = '$priority',incharge = '$assign' WHERE complaints.c_id = '$complaintid';";
  if($conn->query($updatequery) === true)
	{
	    		  	$userassign = " SELECT customer.email,employees.email as eemail,employees.fname,employees.lname,employees.phone,complaints.incharge,complaints.issue from complaints
						inner join customer on customer.u_id = complaints.client_id
						inner join employees on employees.e_id = complaints.incharge
						where u_id = '$clientid' and complaints.c_id = '$complaintid'";
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

						// echo $row['email'] ; 
						 $sendemail = $row['email'];
						 $employeemail = $row['eemail'];
						 $fname = $row['fname'];
						 $lname = $row['lname'];
						 $incharge = $row['incharge'];
						 $phone = $row['phone'];
                         $ctitle = $row['issue'];
		   //email configuration start---------------------------------------------------------------------
				$email_from = 'noreply@apricot.ke';//<== update the email address
				$email_subject = "Update on the service request";
				$email_body = "Your request  has been assigned to $fname. Employee Email: $employeemail and Phone Number: $phone \n\n\n
				'\n\n\n<img src=\"https://management.apricot.ke/images/Capture.JPG\">'\n\n";
				$to = "$sendemail"; //<== update the email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//end of email configuration---------------------------------------------------------------------
			//email configuration start---------------------------------------------------------------------
				$email_from1 = 'info@apricot.ke';//<== update the email address
				$email_subject1 = "New complaint";
				$email_body1 = "You have been assigned a new complaint. Please check the portal for more details.
				Complaint title: $ctitle \n
				'\n\n\n<img src=\"https://management.apricot.ke/images/Capture.JPG\">'\n\n";
				$to1 = "$employeemail"; }}//<== update the email address
				$headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			//end of email configuration---------------------------------------------------------------------
			//Start of mail function ------------------------------------------------------------------------
				if(mail($to,$email_subject,$email_body,$headers))
				{
				    if(mail($to1,$email_subject1,$email_body1,$headers1))
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
				}
				else
				{
					echo '<script>alert("Error Ocurred When Sending the Message. Please Try Again")</script>';
					echo '<script>window.location="RDashBoard.php"</script>';
				} 
			//end of mail function --------------------------------------------------------------------------
	}
	
}

//---------------------------------------------------------------------------------------------------------------
?>
