<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
    $old_UserName = $_POST["old_UserName"];
    $UserName = $_POST["pUserName"];
	$AdminID = $_POST["AdminID"];
	$pEmail = $_POST["pEmail"];
	$pPassword = $_POST["pPassword"];
    $pFirstName = $_POST["pFirstName"];
    $pTelephone = $_POST["pTelephone"];
    $pStatus = $_POST["pStatus"];
    $Permission = $_POST["Permission"];
    $pDateRegis = $_POST["pDateRegis"];

    $old_img = $_POST["ImgProfile"];
    $pImgProfile;
    if ($_FILES["pImgProfile"]["name"] !== ""){
        $filename = $conn->real_escape_string($_FILES['pImgProfile']['name']);
        $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['pImgProfile']['tmp_name'])));
        $filetype = $conn->real_escape_string($_FILES['pImgProfile']['type']);
        $ImgProfile = 'data:'.$filetype.';base64,'.$filedata;
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
}elseif(strlen($pTelephone) !== 10){
    $message = "เบอร์โทรศัพท์ต้องมี 10 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
        </script>"
    );
}else{
    $Sql_Query = "select * from admin where user = '$UserName'";

    $query = mysqli_query($conn, $Sql_Query);

    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($result){
        if($result["user"] === $old_UserName){
            $sql = "UPDATE admin SET 
                        user = '$UserName',
                        password = '$pPassword',
                        email = '$pEmail',
                        name = '$pFirstName',
                        phone = '$pTelephone',
                        pic = '$pImgProfile',
                        Permission = '$Permission',
                        Status = '$pStatus'
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
        $sql = "UPDATE admin SET 
                        user = '$UserName',
                        password = '$pPassword',
                        email = '$pEmail',
                        name = '$pFirstName',
                        phone = '$pTelephone',
                        pic = '$pImgProfile',
                        Permission = '$Permission',
                        Status = '$pStatus'
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
}


mysqli_close($conn);
?>

