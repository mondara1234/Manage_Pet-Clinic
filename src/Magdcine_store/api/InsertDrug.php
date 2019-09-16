<meta charset="utf-8">
<?php
include("../../Database/connect.php");
    $name = $_POST["name"];
    $properties = $_POST["properties"];
    $total = $_POST["total"];
    $price = $_POST["price"];
    $name_Owner = $_POST["name_Owner"];

    $filename = $conn->real_escape_string($_FILES['pDrugIMG']['name']);
    $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['pDrugIMG']['tmp_name'])));
    $filetype = $conn->real_escape_string($_FILES['pDrugIMG']['type']);
    $pDrugIMG = 'data:'.$filetype.';base64,'.$filedata;

if($_FILES["pDrugIMG"]["name"] == ''){
    $message = "กรุณาเลือกรูปภาพยา";
    echo (
    "<script LANGUAGE='JavaScript'>
        window.alert('$message');
    </script>"
    );
}else{
    $Sql_Query = "select * from store_drug where name = '$name' AND name_Owner = '$name_Owner'";

    $query = mysqli_query($conn, $Sql_Query);

    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    if($result){
        $message = "มียาตัวนี้อยู่ในระบบแล้ว";
        echo (
        "<script LANGUAGE='JavaScript'>
            window.alert('$message');
        </script>"
        );
    }else {

        $sql = "INSERT INTO store_drug (name, img, properties, total, price, name_Owner) 
			VALUES ('$name', '$pDrugIMG', '$properties', '$total', '$price', '$name_Owner')";

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
}

	mysqli_close($conn);
?>