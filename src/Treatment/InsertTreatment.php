<meta charset="utf-8">
<?php
include("../Database/connect.php");
    $UserName = $_POST["pUserName"];
    $nameVeterinary = $_POST["nameVeterinary"];
    $phoneVeterinary = $_POST["phoneVeterinary"];
    $title = $_POST["title"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $symptom = $_POST["symptom"];
    $detail = $_POST["detail"];
    $price = $_POST["price"];

    $Sql_Query = "select * from admin where name = '$nameVeterinary'";
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
        $sql = "INSERT INTO history (user, nameVeterinary, phoneVeterinary, title, date, time, symptom, detail, price) 
			VALUES ('$user', '$nameVeterinary', '$phoneVeterinary', '$title', '$date', '$time', '$symptom', '$detail', '$price')";

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