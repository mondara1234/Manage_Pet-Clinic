<meta charset="utf-8">
<?php
include("../../Database/connect.php");
	$pUsername = $_POST["pUsername"];
    $pEmail = $_POST["pEmail"];
	$pPassword = $_POST["pPassword"];
    $date = $_POST["date"];

$Sql_Query = "select * from member where user = '$pUsername'";

    $query = mysqli_query($conn, $Sql_Query);

    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($result){

        $message = "มีชื่อผู้ใช้นี้ในระบบแล้ว";
        echo (
        "<script LANGUAGE='JavaScript'>
            window.alert('$message');
        </script>"
        );
    }else {
            $sql = "INSERT INTO member (user, email, password, DateRegis) 
                    VALUES ('$pUsername', '$pEmail', '$pPassword', '$date')";

            $query = mysqli_query($conn, $sql);

            if($query){
                $message = "เพิ่มข้อมูลเสร็จสิ้น";
                echo (
                "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
                );
            }else{
                $message = "เพิ่มข้อมูลล้มเหลว";
                echo (
                "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
                );
            }
        }
	
	mysqli_close($conn);
?>