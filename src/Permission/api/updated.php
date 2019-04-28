<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
    $UserID = $_POST["UserID"];
	$Permission = $_POST["Permission"];
	$UserName = $_GET["UserName"];

	$sql = "UPDATE adminmanage SET 
			Permission = '$Permission'
			
			WHERE ID = $UserID ";
	$query = mysqli_query($conn, $sql);
	$PrimissionTh = '';

    if($Permission === 'allow'){
        $PrimissionTh = 'อนุญาติ';
    }else if($Permission === 'disallow'){
        $PrimissionTh = 'ไม่อนุญาติ';
    }

	if($query){
        $message = "เปลี่ยนสถานะเป็น $PrimissionTh สำเร็จ";
        echo (
        "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../Permission.php?UserName=$UserName';
        </script>"
        );
	}else{
        $message = "ลองใหม่อีกครั้ง";
        echo (
        "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../Permission.php?UserName=$UserName';
        </script>"
        );
	}
	mysqli_close($conn);
?>
