<?php
include('../Database/connect.php');
$UserName = $_GET["UserName"];
$name_customer = null;
if(isset($_GET["document_number"])){
    $document_number = $_GET["document_number"];
};
		  

$sql  = "SELECT * FROM receipt WHERE document_number = '$document_number' ";
$result = $conn->query($sql);

while($row=$result->fetch_assoc()){ 
	$sqlDelete = "DELETE FROM receipt WHERE ID = '".$row["ID"]."'";
	if($conn->query($sqlDelete)==TRUE){
	  echo "<script>";
	  echo "alert('ลบข้อมูลเรียบร้อย');";
	  echo "window.location.href='showdata_Receipt.php?UserName=$UserName';";
	  echo "</script>";
	}else{
	  echo "ERROR ".$sqlDelete."<BR>".$conn->error;
  }
}	
?>