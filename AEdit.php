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
	$chair = ($_POST['chair']);
	$p_id = ($_POST['p_id']);
  	$updatequery = "UPDATE property set chair = '$chair' WHERE property.p_id = '$p_id';";
  	if($conn->query($updatequery) === true)
	{
	    echo '<script>alert("The Chairman has been updated")</script>';
	   	echo '<script>window.location="ADashBoard.php"</script>';
	}

}
?>