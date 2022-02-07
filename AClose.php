<?php
	session_start();
require 'db.php';

if (!isset($_COOKIE["user"]))
{
  header("location:  Index.php");
  exit();
}
$Username = $_COOKIE["user"];
//-------------------------Close complaint completely-----------------------------------------
//---------------------------------------------------------------------------------------------------------------
if($_SERVER['REQUEST_METHOD']==='POST')
{
  $authorize =($_POST['authorize']);
  $status = ($_POST['status']);
  $complaintid = ($_POST['cid']);
  $remark = ($_POST['remark']);
  $updatequery = "UPDATE complaints set authorizer = '$authorize', complaints.`status` = '$status', remarks = '$remark' WHERE complaints.c_id = '$complaintid';";
  if($conn->query($updatequery) === true)
	{
	    echo '<script>alert("The complaint has been closed")</script>';
	   	echo '<script>window.location="ADashBoard.php"</script>';
	}
else{
	echo "eeror";
}

}
//--------------------------------------------------------------------------------------------------------------
//-------------------------Close complaint completely-----------------------------------------
?>