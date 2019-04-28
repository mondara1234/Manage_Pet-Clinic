<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
    $old_UserName = $_POST["old_UserName"];
    $UserName = $_POST["pUserName"];
	$UserID = $_POST["UserID"];
	$title = $_POST["title"];
	$date = $_POST["date"];
    $time = $_POST["time"];
    $Responsible = $_POST["Responsible"];
    $phoneVeterinary = $_POST["phoneVeterinary"];

$Sql_Query = "select * from sledging where user = '$UserName'";

$query = mysqli_query($conn, $Sql_Query);

$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($result){
    if($result["user"] === $old_UserName){
        $sql = "UPDATE sledging SET 
                        user = '$UserName',
                        title = '$title',
                        date = '$date',
                        time = '$time',
                        Responsible = '$Responsible',
                        phoneVeterinary = '$phoneVeterinary'
                        WHERE id = $UserID ";

        $query = mysqli_query($conn, $sql);

        if($query){
            $message = "แก้ไขข้อมูลสำเร็จ";
            echo (
            "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
            );
        }else{
            $message = "แก้ไขข้อมูลล้มเหลว";
            echo (
            "<script LANGUAGE='JavaScript'>
                        window.alert('$message');
                    </script>"
            );
        }
    }else{
        $message = "ไม่มีชื่อผู้ใช้นี้ในระบบ";
        echo (
        "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
        );
    }
}else {
    $sql = "UPDATE sledging SET 
                        user = '$UserName',
                        title = '$title',
                        date = '$date',
                        time = '$time',
                        Responsible = '$Responsible',
                        phoneVeterinary = '$phoneVeterinary'
                        WHERE id = $UserID ";

    $query = mysqli_query($conn, $sql);

    if($query){
        $message = "แก้ไขข้อมูลสำเร็จ";
        echo (
        "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
        );
    }else{
        $message = "แก้ไขข้อมูลล้มเหลว";
        echo (
        "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
        );
    }

}


mysqli_close($conn);
?>

