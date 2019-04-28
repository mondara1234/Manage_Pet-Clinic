<meta charset="utf-8">
<?php
include("../Database/connect.php");
$UserName = $_POST["pUserName"];
$title = $_POST["title"];
$date = $_POST["date"];
$time = $_POST["time"];
$Responsible = $_POST["Responsible"];
$phoneVeterinary = $_POST["phoneVeterinary"];

$Sql_Query = "select * from admin where name = '$Responsible'";
$query = mysqli_query($conn, $Sql_Query);
$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

$Sql_Querys = "select * from member where nameuser = '$UserName'";
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
    $message = "ไม่มีชื่อเจ้าของสัตว์เลี้ยงนี้อยู่ในระบบ";
    echo (
    "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
    );
}else {
    $user = $results['user'];
    $sql = "INSERT INTO sledging (user, title, date, time, Responsible, phoneVeterinary, nameuser) 
			VALUES ('$user','$title', '$date', '$time', '$Responsible', '$phoneVeterinary', '$UserName')";

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
    $iduser = $results['id'];
    $sqls = "UPDATE member SET 
			nameVeterinary = '$Responsible',
			phoneVeterinary = '$phoneVeterinary'
			
			WHERE id = '$iduser' ";
    $querys = mysqli_query($conn, $sqls);
}

mysqli_close($conn);
?>