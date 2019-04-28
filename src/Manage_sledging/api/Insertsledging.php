<meta charset="utf-8">
<?php
include("../../Database/connect.php");
$UserName = $_POST["pUserName"];
$title = $_POST["title"];
$nameuser = $_POST["nameuser"];
$date = $_POST["date"];
$time = $_POST["time"];
$Responsible = $_POST["Responsible"];
$phoneVeterinary = $_POST["phoneVeterinary"];

$Sql_Query = "select * from admin where name = '$Responsible'";
$query = mysqli_query($conn, $Sql_Query);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

$Sql_Querys = "select * from member where user = '$UserName' AND nameuser = '$nameuser'";
$querys = mysqli_query($conn, $Sql_Querys);
$results = mysqli_fetch_array($querys, MYSQLI_ASSOC);

if(!$result){
    $message = "ไม่มีสัตวแพทย์คนนี้อยู่ในระบบ";
    echo (
    "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
    );
}elseif(!$results){
    $message = "ชื่อผู้ใช้ หรือ ชื่อเจ้าของสัตว์เลี้ยง ไม่ถูกต้อง หรือไม่ตรงกัน";
    echo (
    "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
    );
}else {
    $sql = "INSERT INTO sledging (user, title, date, time, Responsible, phoneVeterinary, nameuser) 
			VALUES ('$UserName','$title', '$date', '$time', '$Responsible', '$phoneVeterinary', '$nameuser')";

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