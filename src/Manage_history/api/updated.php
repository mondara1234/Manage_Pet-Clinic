<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
    $old_UserName = $_POST["old_UserName"];
    $UserName = $_POST["pUserName"];
	$AdminID = $_POST["AdminID"];
    $nameuser = $_POST["nameuser"];
	$nameVeterinary = $_POST["nameVeterinary"];
	$phoneVeterinary = $_POST["phoneVeterinary"];
    $title = $_POST["title"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $symptom = $_POST["symptom"];
    $detail = $_POST["detail"];
    $price = $_POST["price"];

$Sql_Query = "select * from history where user = '$UserName'";

$query = mysqli_query($conn, $Sql_Query);

$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($result){
    if($result["user"] === $old_UserName){
        $sql = "UPDATE history SET 
                        user = '$UserName',
                        nameuser = '$nameuser',
                        nameVeterinary = '$nameVeterinary',
                        phoneVeterinary = '$phoneVeterinary',
                        title = '$title',
                        date = '$date',
                        time = '$time',
                        symptom = '$symptom',
                        detail = '$detail',
                        price = '$price'
                        WHERE id = $AdminID ";

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
    $sql = "UPDATE history SET 
                user = '$UserName',
                nameuser = '$nameuser',
                nameVeterinary = '$nameVeterinary',
                phoneVeterinary = '$phoneVeterinary',
                title = '$title',
                date = '$date',
                time = '$time',
                symptom = '$symptom',
                detail = '$detail',
                price = '$price'
                WHERE id = $AdminID ";

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

