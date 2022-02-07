<?php  
session_start();
require 'db.php';
require_once('tcpdf/tcpdf.php');  
    $type =($_GET['type']);
    $p_id = ($_GET["id"]);
    $start = ($_GET["date1"]);
    $date = str_replace('/', '-', $start );
    $newDate = date("Y-m-d", strtotime($date));
   // echo $newDate;
    $end = ($_GET["date2"]);
    $date1 = str_replace('/', '-', $end );
    $newDate1 = date("Y-m-d", strtotime($date1));
   // echo $newDate1;
function fetch_data($a,$b,$c,$d) 
{  
      $output = '';  
      $conn = new mysqli('localhost','apricotk_abhi','MO{7{Q{2B=Dk','apricotk_databasetest');
      
      $sql = "SELECT c_id,issue,issuedesc,complaints.`type`,complaints.`status`,solution,cost,property.name from complaints left join property on complaints.p_id = property.p_id
        where complaints.`type` = '$a' and property.p_id = '$b' and complaints.startdate between '$c' and '$d';";  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {
          
         $output .= '<tr>   
                          <td>'. $row["c_id"].' </td>   
                          <td>'. $row["name"].' </td> 
                          <td>'. $row["issue"].' </td>  
                          <td>'. $row["issuedesc"].' </td>  
                          <td>'. $row["status"].' </td>  
                          <td>'. $row["solution"].' </td>  
                          <td>'. $row["cost"].' </td> 
                     </tr>  
                    ';  
      } 
      return $output;  
}  
 if(isset($_POST["generate_pdf"]))  
{  
      require_once('tcpdf/tcpdf.php');  
      $obj_pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Issues Report");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 11);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h4 align="center">Issues Report</h4><br /><br />
      <h4 align="center">Type of Issue: '. $type .'</h4><br /><br />
      <h4 align="center">From '. $newDate .' To '.$newDate1.'</h4><br /><br />
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="8%">Complaint ID</th> 
                <th width="10%">Property Name</th> 
                <th width="8%">Title of the Issue</th>  
                <th width="27%">Description of the Issue</th>  
                <th width="12%">Status</th>  
                <th width="27%">Action Taken</th>  
                <th width="10%">Cost Incurred in KSHS.</th>  
                
           </tr>  
      ';  
      $content .= fetch_data($type,$p_id,$newDate,$newDate1);  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
}  
?>  
 <!DOCTYPE html>  
 <html>  
      <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">  
           <title>Apricot Property Solutions Portal</title>  
           <link rel="stylesheet" type="text/css" href="css/bootstrap.css">            
      </head>  
      <body> 
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Apricot Property Solutions Portal</a>
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
           <br />
           <div class="container">  
                <h4 align="center">Report</h4><br />  
                <div class="table-responsive">  
                	<div class="col-md-12" align="right">
                     <form method="post">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
                     </form>  
                     </div>
                     <br/>
                     <br/>
                     <table class="table">
                        <thead class="thead-dark">  
                        <tr>  
                          <th>Complaint ID</th> 
                          <th>Property Name</th> 
                          <th>Title of the Issue</th>  
                          <th>Description of the Issue</th>  
                          <th>Status</th>  
                          <th>Action Taken</th>  
                          <th>Cost Incurred in KSHS.</th>  
                        </tr> 
                        </thead>
                     <?php  
                      $sql = "SELECT c_id,issue,issuedesc,complaints.`type`,complaints.`status`,solution,cost,property.name from complaints left join property on complaints.p_id = property.p_id
        where complaints.`type` = '$type' and property.p_id = '$p_id' and complaints.startdate between '$newDate' and '$newDate1';";
       
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) 
                        {
                     ?>  
                     <tr> 
                          <td><?php echo $row['c_id']?></td>  
                          <td><?php echo $row['name']?></td> 
                          <td><?php echo $row['issue']?></td>  
                          <td><?php echo $row['issuedesc']?></td>  
                          <td><?php echo $row['status']?></td>  
                          <td><?php echo $row['solution']?></td>  
                          <td><?php echo $row['cost']?></td>  
                     </tr> 
                     <?php
                        }
                     ?>
                     </table>  
                </div>  
           </div>  
      </body>  
</html>

