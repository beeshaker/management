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
  $status = ($_POST['status']);
  $cost = ($_POST['cost']);
  $enddate = ($_POST['dateofentry']);
  $solution = ($_POST['solve']);
  $complaintid = ($_POST['cid']);
  $updatequery = "UPDATE complaints set complaints.`status` = '$status',complaints.cost = '$cost',complaints.enddate = '$enddate',complaints.solution = '$solution' WHERE complaints.c_id = '$complaintid';";
  if($conn->query($updatequery) === true)
  {
      echo '<script>alert("The complaint has been closed")</script>';
      echo '<script>window.location="CDashBoard.php"</script>';
  }

}
//--------------------------------------------------------------------------------------------------------------
//-------------------------Close complaint completely-----------------------------------------
?>