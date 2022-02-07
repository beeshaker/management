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
		$date = ($_POST['dateofentry']);
		$title = ($_POST['title']);
		$announce = ($_POST['announce']); 
		$pid = ($_POST['property']); 
	  	$sql = "INSERT INTO announcement(p_id,dateofannouncement,title,announcements) VALUES('$pid','$date','$title','$announce')";
	  	if($conn->query($sql) === true)
	  	{
	  		echo '<script>alert("The announcements has been posted")</script>';
      		echo '<script>window.location="CDashBoard.php"</script>';
	  	}
	  	else
	  	{
	  		echo '<script>alert("The announcements has not been posted")</script>';
      		echo '<script>window.location="CDashBoard.php"</script>';
	  	}
}
?>