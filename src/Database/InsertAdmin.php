<meta charset="utf-8">
<?php
include("connect.php");
	$Username = $_POST["txtUsername"];
    $Email = $_POST["txtEmail"];
	$Password = $_POST["txtPassword"];
    $Re_Password = $_POST["txtConfirmPassword"];
    $First_name = $_POST["txtFirst_name"];
    $Telephone = $_POST["txtTelephone"];
    $DateRegis = $_POST["date"];
    $Status = 'admin';
    $Permission = 'pending';

    $old_img = 'https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1';
    $ImgProfile;
    if ($_FILES["txtImgProfile"]["name"] !== ""){
        $filename = $conn->real_escape_string($_FILES['txtImgProfile']['name']);
        $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['txtImgProfile']['tmp_name'])));
        $filetype = $conn->real_escape_string($_FILES['txtImgProfile']['type']);
        $ImgProfile = 'data:'.$filetype.';base64,'.$filedata;
    }else{
        $ImgProfile = $old_img;
    }

if(strlen($Username) < 4){
    $message = "ชื่อผู้ใช้ต้องมีอย่างน้อย 4 ตัวขึ้นไป";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
    </script>"
    );
}elseif(strlen($Password) < 6 || strlen($Re_Password) < 6 ){
    $message = "รหัสผ่านต้องมีอย่างน้อย 6 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
    </script>"
    );
}elseif($Password !== $Re_Password){
    $message = "รหัสผ่านไม่ตรงกัน";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
    </script>"
    );
}elseif(strlen($Telephone) !== 10){
    $message = "เบอร์โทรศัพท์ต้องมี 10 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
    </script>"
    );
}else{
    $Sql_Query = "select * from admin where user = '$Username'";

    $query = mysqli_query($conn, $Sql_Query);

    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($result){
            $message = "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว";
            echo (
            "<script LANGUAGE='JavaScript'>
                window.alert('$message');
            </script>"
            );
    }else {
            $sql = "INSERT INTO admin (user, email, password, name, phone, pic, Permission, DateRegis, Status) 
			VALUES ('$Username', '$Email', '$Password', '$First_name', '$Telephone', '$ImgProfile', '$Permission', '$DateRegis', '$Status')";

            $query = mysqli_query($conn, $sql);

            if($query){
                $message = "ลงทะเบียนเสร็จสิ้นรอการอนุมัติจากเจ้าของระบบนะครับ";
                echo (
                "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                    window.location.href='../login/register.php';
                </script>"
                );
            }else{
                $message = "ลงทะเบียนล้มเหลว";
                echo (
                "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                    window.location.href='../login/register.php';
                </script>"
                );
            }
        }
    }
	
	mysqli_close($conn);
?>