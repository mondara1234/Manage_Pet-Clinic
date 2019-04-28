<meta charset="utf-8">
<?php
    include('connect.php');
    if(empty($_SESSION)) // if the session not yet started
    session_start();

    $txtUsername = $_POST["txtUsername"];
    $txtPassword = $_POST["txtPassword"];

    $_SESSION['username'] = $txtUsername;  // if already login

    $Sql_Query = "select * from admin where user = '$txtUsername' and password = '$txtPassword' ";
	$query = mysqli_query($conn, $Sql_Query);
	$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

        if (!$result){
            $message = "ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง!";
            echo (
            "<script LANGUAGE='JavaScript'>
                window.alert('$message');
                window.location.href='./../../index.html';
            </script>"
            );
        }else{

            if($result["Permission"] === 'allow'){
                header("location:../Homepage.php?UserName=$txtUsername");
                exit;
            }else{
                $message = "คุณยังไม่ได้รับการอนุมัติการเข้าใช้จากเจ้าของระบบ";
                echo (
                    "<script LANGUAGE='JavaScript'>
                        window.alert('$message');
                        window.location.href='./../../index.html';
                    </script>"
                );
            }

        }

    mysqli_close($conn);

?>