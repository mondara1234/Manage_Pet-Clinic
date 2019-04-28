<meta charset="utf-8">
<?php
include("../../Database/connect.php");
$UserName = $_POST["pUserName"];
$nameVeterinary = $_POST["nameVeterinary"];
$old_date= $_POST["old_date"];
$title = $_POST["title"];
$date = $_POST["date"];
$time = $_POST["time"];
$symptom = $_POST["symptom"];
$detail = $_POST["detail"];
$status = $_POST["status"];

$Sql_Query = "select * from admin where name = '$nameVeterinary'";
$query = mysqli_query($conn, $Sql_Query);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

$Sql_Querys = "select * from member where user = '$UserName'";
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
    $message = "ไม่มีผู้ใช้คนนี้อยู่ในระบบ";
    echo (
    "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
    );
}else {
    $sql = "INSERT INTO postponement (user, Responsible, title, date, time, old_date, detail, status) 
			VALUES ('$UserName', '$nameVeterinary', '$title', '$date', '$time', '$old_date', '$detail', '$status')";

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