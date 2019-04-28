<meta charset="utf-8">
<?php
include("../../Database/connect.php");
$old_date = $_GET["old_date"];
$UserName = $_GET["UserName"];
$date = $_GET["date"];
$time = $_GET["time"];
$value = $_GET["value"];
$id = $_GET["id"];

$Sql_Querys = "select * from sledging where nameuser = '$UserName' AND date = '$old_date'";
$querys = mysqli_query($conn, $Sql_Querys);
$results = mysqli_fetch_array($querys, MYSQLI_ASSOC);

$idUser = $results['id'];
if($value === 'อนุมัติ'){
    $sql = "UPDATE sledging SET 
			date = '$date',
			time = '$time'
			
			WHERE id = '$idUser' ";
    $query = mysqli_query($conn, $sql);

    $sql = "UPDATE postponement SET 
			status = '$value'
			
			WHERE id = '$id' ";
    $query = mysqli_query($conn, $sql);

}else{
    $sql = "UPDATE postponement SET 
			status = '$value'
			
			WHERE id = '$id' ";
    $query = mysqli_query($conn, $sql);
}

mysqli_close($conn);
?>
