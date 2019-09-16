<?php
header('Content-Type: application/json');
include('../Database/connect.php');

$date = $_POST["dateformat"];

	  $sql  = "INSERT INTO Receipt (name_customer, name_animals, tel_customer, name_caretaker, tel_caretaker, date,
          count, txtList, number, price, total, txtCause, discount, Balance, TotalAll, document_number)
		   VALUES ('".$_POST['name_customer']."','".$_POST['name_animals']."','".$_POST['tel_customer']."',
		   '".$_POST['name_caretaker']."','".$_POST['tel_caretaker']."','$date','".$_POST['count']."',
		   '".$_POST['txtList']."','".$_POST['number']."','".$_POST['price']."','".$_POST['total']."',
		   '".$_POST['txtCause']."','".$_POST['discount']."','".$_POST['Balance']."','".$_POST['TotalAll']."','".$_POST['document_number']."' )";

        $query = mysqli_query($conn, $sql);
    if($query){
        $msg = 'บันทึกสำเร็จ';
        echo json_encode($msg);
	  }else{
	  	echo mysqli_error($conn);
	  }

mysqli_close($conn);
?>
