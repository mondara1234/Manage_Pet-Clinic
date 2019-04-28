<meta charset="utf-8">
<?php
include("../../Database/connect.php");
$UserNameold = $_GET["UserName"];
$UserName = $_POST["UserNameAD"];
$UserID = $_POST["UserID"];
$Password = $_POST["Password"];
$Email = $_POST["Email"];
$FirstName = $_POST["FirstName"];
$LastName = $_POST["LastName"];
$Address = $_POST["Address"];
$Telephone = $_POST["Telephone"];

$old_img = $_POST["ImgProfile"];
$ImgProfile;
if ($_FILES["pImgProfile"]["name"] !== ""){
    $filename = $conn->real_escape_string($_FILES['pImgProfile']['name']);
    $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['pImgProfile']['tmp_name'])));
    $filetype = $conn->real_escape_string($_FILES['pImgProfile']['type']);
    $ImgProfile = 'data:'.$filetype.';base64,'.$filedata;
}else{
    $ImgProfile = $old_img;
}

if(empty($UserName) ||
    empty($Password) ||
    empty($Email) ||
    empty($FirstName) ||
    empty($LastName) ||
    empty($Address) ||
    empty($Telephone)) {
    $message = "กรุณากรอกข้อมูลให้ครบ";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../edit_Profile.php?UserName=$UserNameold';
        </script>"
    );
}elseif(strlen($Password) < 6){
    $message = "รหัสผ่านต้องมีอย่างน้อย 6 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../edit_Profile.php?UserName=$UserNameold';
        </script>"
    );
}elseif(strlen($UserName) < 4){
    $message = "ชื่อผู้ใช้ต้องมีอย่างน้อย 4 ตัวขึ้นไป";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../edit_Profile.php?UserName=$UserNameold';
        </script>"
    );
}elseif(strlen($Password) < 6 ){
    $message = "รหัสผ่านต้องมีอย่างน้อย 6 ตัว";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
        </script>"
    );
}elseif(strlen($Telephone) !== 10){
    $message = "เบอร์โทรต้องมี 10 หลัก";
    echo (
    "<script LANGUAGE='JavaScript'>
            window.alert('$message');
            window.location.href='../edit_Profile.php?UserName=$UserNameold';
        </script>"
    );
}else{
    $Sql_Query = "select * from adminmanage where UserName = '$UserName'";

    $query = mysqli_query($conn, $Sql_Query);

    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($result){
        if($result["UserName"] === $UserNameold){
            $sql = "UPDATE adminmanage SET 
                        UserName = '$UserName',
                        Password = '$Password',
                        Email = '$Email',
                        FirstName = '$FirstName',
                        LastName = '$LastName',
                        Address = '$Address',
                        Telephone = '$Telephone',
                        ImgProfile = '$ImgProfile'
                        WHERE ID = $UserID ";

            $query = mysqli_query($conn, $sql);

            if($query){
                $message = "แก่ไขข้อมูลสำเร็จ";
                echo (
                "<script LANGUAGE='JavaScript'>
                        window.alert('$message');
                        window.location.href='../edit_Profile.php?UserName=$UserName';
                    </script>"
                );
            }else{
                $message = "แก้ไขข้อมูลล้มเหลว";
                echo (
                "<script LANGUAGE='JavaScript'>
                        window.alert('$message');
                        window.location.href='../edit_Profile.php?UserName=$UserNameold';
                    </script>"
                );
            }
        }else{
            $message = "ชื่อผู้ใช้นี้ถูกใช้ไปแล้ว";
            echo (
            "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                    window.location.href='../edit_Profile.php?UserName=$UserNameold';
                </script>"
            );
        }
    }else {
        $sql = "UPDATE adminmanage SET 
                    UserName = '$UserName',
                    Password = '$Password',
                    Email = '$Email',
                    FirstName = '$FirstName',
                    LastName = '$LastName',
                    Address = '$Address',
                    Telephone = '$Telephone',
                    ImgProfile = '$ImgProfile'
                    WHERE ID = $UserID ";

        $query = mysqli_query($conn, $sql);

        if($query){
            $message = "แก่ไขข้อมูลสำเร็จ";
            echo (
            "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                    window.location.href='../edit_Profile.php?UserName=$UserName';
                </script>"
            );
        }else{
            $message = "แก้ไขข้อมูลล้มเหลว";
            echo (
            "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                    window.location.href='../edit_Profile.php?UserName=$UserNameold';
                </script>"
            );
        }
    }
}
mysqli_close($conn);
?>