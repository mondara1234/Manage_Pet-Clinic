<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
    $old_Username = $_POST["old_Username"];
	$UserID = $_POST["UserID"];
	$pEmail = $_POST["pEmail"];
	$pPassword = $_POST["pPassword"];
    $nameuser = $_POST["nameuser"];
    $phoneuser = $_POST["phoneuser"];
	$pnameAnimal = $_POST["nameAnimal"];
    $psexAnimal = $_POST["sexAnimal"];
    $pbreedAnimal = $_POST["breedAnimal"];
    $pbirthAnimal = $_POST["birthAnimal"];

    $old_img = $_POST["ImgProfile"];
    $pImgProfile;
    if ($_FILES["pImgProfile"]["name"] !== ""){
        $filename = $conn->real_escape_string($_FILES['pImgProfile']['name']);
        $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['pImgProfile']['tmp_name'])));
        $filetype = $conn->real_escape_string($_FILES['pImgProfile']['type']);
        $pImgProfile = 'data:'.$filetype.';base64,'.$filedata;
    }else{
        $pImgProfile = $old_img;
    }

if(strlen($pPassword) < 6){
    $message = "รหัสผ่านต้องมีอย่างน้อย 6 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
        </script>"
    );
}else{
$Sql_Query = "select * from member where user = '$pUsername'";

$query = mysqli_query($conn, $Sql_Query);

$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($result){
    if($result["user"] === $old_Username){
        $sql = "UPDATE member SET 
                email = '$pEmail',
                password = '$pPassword',
                nameuser = '$nameuser', 
                phone = '$phoneuser',
                nameAnimal= '$pnameAnimal', 
                sexAnimal = '$psexAnimal', 
                birthAnimal = '$pbirthAnimal', 
                breedAnimal = '$pbreedAnimal',
                picAnimal = '$pImgProfile'
                
                WHERE id = $UserID ";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            $message = "แก่ไขข้อมูลสำเร็จ";
            echo(
            "<script LANGUAGE='JavaScript'>
                window.alert('$message');
            </script>"
            );
        } else {
            $message = "แก่ไขข้อมูลล้มเหลว";
            echo(
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
    $sql = "UPDATE member SET 
                email = '$pEmail',
                password = '$pPassword',
                nameuser = '$nameuser', 
                phone = '$phoneuser',
                nameAnimal= '$pnameAnimal', 
                sexAnimal = '$psexAnimal', 
                birthAnimal = '$pbirthAnimal', 
                breedAnimal = '$pbreedAnimal',
                picAnimal = '$pImgProfile'
                
                WHERE id = $UserID ";

        $query = mysqli_query($conn, $sql);

        if ($query) {
            $message = "แก้ไขข้อมูลสำเร็จ";
            echo(
            "<script LANGUAGE='JavaScript'>
                window.alert('$message');
            </script>"
            );
        } else {
            $message = "แก้ไขข้อมูลล้มเหลว";
            echo(
            "<script LANGUAGE='JavaScript'>
                window.alert('$message');
            </script>"
            );
        }
    }
}
	mysqli_close($conn);
?>
