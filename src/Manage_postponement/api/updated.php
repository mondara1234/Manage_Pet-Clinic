<meta charset="utf-8">
<?php
include("../../Database/connect.php");
$old_UserName = $_POST["old_UserName"];
$UserName = $_POST["pUserName"];
$nameuser = $_POST["nameuser"];
$PostID = $_POST["PostID"];
$nameVeterinary = $_POST["nameVeterinary"];
$old_date= $_POST["old_date"];
$title = $_POST["title"];
$date = $_POST["date"];
$time = $_POST["time"];
$symptom = $_POST["symptom"];
$detail = $_POST["detail"];
$status = $_POST["status"];

$Sql_Query = "select * from postponement where user = '$UserName'";

$query = mysqli_query($conn, $Sql_Query);

$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($result){
    if($result["user"] === $old_UserName){
        $sql = "UPDATE postponement SET 
                user = '$UserName',
                Responsible = '$nameVeterinary',
                nameuser = '$nameuser',
                title = '$title',
                date = '$date',
                time = '$time',
                old_date = '$old_date',
                detail = '$detail',
                status = '$status'
                WHERE id = $PostID ";

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
        $message = "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว";
        echo (
        "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
        );
    }
}else {
    $sql = "UPDATE postponement SET 
                user = '$UserName',
                Responsible = '$nameVeterinary',
                nameuser = '$nameuser',
                title = '$title',
                date = '$date',
                time = '$time',
                old_date = '$old_date',
                detail = '$detail',
                status = '$status'
                WHERE id = $PostID ";

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

