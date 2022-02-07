<?php
session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
	header("location:  Index.php");
	exit();
}
$Username = $_COOKIE["user"];
$cid = "";
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
    	 $cid = $row['u_id'];
    	// echo $cid;
    	// echo $pid;
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
	    <!--JQuery-->  
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  

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
					<div class="col-md-3">
						<div style="padding-top: 2%; padding-bottom: 2%;  padding-left: 10%">
							<ul style="padding-top: 2%; padding-bottom: 2%; padding-right: 0%; padding-left: 0%;list-style-type: none;">
				      			<li style="padding-top: 2%; padding-bottom: 2%;"><h5 style="text-align: justify;">Actions</h5></li>
				      			<li style="padding-top: 2%; padding-bottom: 2%;">
				      			</li>
			      			</ul>
						</div>
					</div>
					<div class="col-md-9" style=" padding-left: 2%; padding-top: 3%; padding-bottom: 3%;">
						<div style="padding-top: 3%; padding-bottom: 3%;  padding-left: 36%; ">
							<h1>View Announcements</h1>
						</div>
						<div style="padding-top: 3%; padding-bottom: 2%; padding-left: 6%; ">
							<div class="container">
								<?php
									$sql = "SELECT announcement.a_id,announcement.p_id,announcement.dateofannouncement,announcement.title,announcement.announcements
										from announcement inner join customer on announcement.p_id = customer.pid where  customer.u_id = '$cid' order by announcement.dateofannouncement DESC ;";
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
									   

								?>
								<table class="table">
		  							<thead class="thead-dark">
									<tr>
										<th style="size: 80%;">Title: <?php echo $row['title']; ?></th>
										<th style="size: 20%;">Date: <?php echo $row['dateofannouncement']; ?></th>
									</tr>
									</thead>
									<tbody>
									<tr>
										<td>Announcement:  
												<?php echo $row['announcements']; ?>
										</td>
									</tr>
									</tbody>
								</table>
								<?php
									}}
								?>
								
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