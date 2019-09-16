<meta charset="utf-8">
<?php
include('../../Database/connect.php');
$UserName = $_GET["UserName"];
$ID = null;
if(isset($_GET["DrugID"])){
    $ID = $_GET["DrugID"];
}
$sql = "DELETE FROM store_drug WHERE ID = $ID";
$query = mysqli_query($conn, $sql);
if(mysqli_affected_rows($conn)){
    $message = "ลบสำเร็จ";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
        window.location.href='../ManageDrug.php?UserName=$UserName';
    </script>"
    );
}else{
    $message = "ลองใหม่อีกครั้ง";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
        window.location.href='../ManageDrug.php?UserName=$UserName';
    </script>"
    );
}
?>