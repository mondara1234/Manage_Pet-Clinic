<meta charset="utf-8">
<?php
	include("../../Database/connect.php");
$ID = $_POST["ID"];
$name = $_POST["name"];
$old_name = $_POST["old_name"];
$properties = $_POST["properties"];
$total = $_POST["total"];
$price = $_POST["price"];
$name_Owner = $_POST["name_Owner"];

$old_img = $_POST["pDrugIMG"];
$pDrugIMG;
if ($_FILES["DrugIMG"]["name"] !== ""){
    $filename = $conn->real_escape_string($_FILES['DrugIMG']['name']);
    $filedata= $conn->real_escape_string(base64_encode(file_get_contents($_FILES['DrugIMG']['tmp_name'])));
    $filetype = $conn->real_escape_string($_FILES['DrugIMG']['type']);
    $pDrugIMG = 'data:'.$filetype.';base64,'.$filedata;
}else{
    $pDrugIMG = $old_img;
}

$Sql_Query = "select * from store_drug where name = '$name' AND name_Owner = '$name_Owner'";

$query = mysqli_query($conn, $Sql_Query);

$result = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($result){
    if($result["name"] === $old_name){
        $sql = "UPDATE store_drug SET 
                        name = '$name',
                        img = '$pDrugIMG',
                        properties = '$properties',
                        total = '$total',
                        price = '$price',
                        name_Owner = '$name_Owner'
                        WHERE ID = $ID ";

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
        $message = "ชื่อยาตัวนี้ถูกใช้ไปแล้ว";
        echo (
        "<script LANGUAGE='JavaScript'>
                    window.alert('$message');
                </script>"
        );
    }
}else {
    $sql = "UPDATE store_drug SET 
                        name = '$name',
                        img = '$pDrugIMG',
                        properties = '$properties',
                        total = '$total',
                        price = '$price',
                        name_Owner = '$name_Owner'
                        WHERE ID = $ID ";

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

