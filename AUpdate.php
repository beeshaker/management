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
  $desc = $conn->escape_string($_POST['desc']);
  $priority =($_POST['priority']);
  $assign = ($_POST['assign']);
  $complaintid = ($_POST['complaintid']);
  $updatequery = "UPDATE complaints set image = '$filetarget',issuedesc = '$desc',priority = '$priority',incharge = '$assign' WHERE complaints.c_id = '$complaintid';";
  if($conn->query($updatequery) === true)
	{
	    echo '<script>alert("The complaint has been updated")</script>';
	   	echo '<script>window.location="ADashBoard.php"</script>';
	}
	
}

//---------------------------------------------------------------------------------------------------------------
?>