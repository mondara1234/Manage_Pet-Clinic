<?php
session_start();
date_default_timezone_set("Asia/Bangkok");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--  ให้รองรับและ แสดงหน้าตา ใน IE=edge ได้โดยไม่ผิดเพี้ยน-->
    <!-- กำหนดขนาด initial-scale=1.0 = เพื่อไม่ให้  Safari Zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--  device-width = “ขนาด” ของ device นั้นๆ-->
    <meta name="description" content="">  <!--  บอกรายละเอียดของเว็บเพจแบบคร่าวๆ-->
    <meta name="author" content=""> <!-- ผู้เขียนหน้านี้ -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png">

    <!-- Custom CSS -->
    <link href="../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../assets/dist/css/style.min.css" rel="stylesheet">
    <link href="../assets/dist/css/styleCommon.css" rel="stylesheet">
    <style type="text/css">
        .container{
            margin-left: 160px;
            padding: 0px 10px;
        }
    </style>
    <?php
    include('../Database/connect.php');

    $UserName = $_GET["UserName"];
    $sqlmanage = "SELECT * FROM admin WHERE user = '$UserName' ";
    $querymanage = mysqli_query($conn, $sqlmanage);
    $resultUser = mysqli_fetch_array($querymanage, MYSQLI_ASSOC);

    $sqlAdminmanage = "SELECT COUNT(*) as totalAdminmanage FROM admin WHERE Permission = 'pending' ";
    $queryAdminmanage = mysqli_query($conn, $sqlAdminmanage);
    $resultAdminmanage = mysqli_fetch_array($queryAdminmanage, MYSQLI_ASSOC);

    $status =$resultUser['Status'];
    $name =$resultUser['name'];
    if($status === 'superadmin'){
        $sqlAllPostponement = "SELECT COUNT(*) as totalAllPostponement FROM postponement WHERE status = 'รออนุมัติ'";
        $queryAllPostponement = mysqli_query($conn, $sqlAllPostponement);
        $resultAllPostponement = mysqli_fetch_array($queryAllPostponement, MYSQLI_ASSOC);
    }else{
        $sqlAllPostponement = "SELECT COUNT(*) as totalAllPostponement FROM postponement WHERE status = 'รออนุมัติ' AND Responsible = '$name'";
        $queryAllPostponement = mysqli_query($conn, $sqlAllPostponement);
        $resultAllPostponement = mysqli_fetch_array($queryAllPostponement, MYSQLI_ASSOC);
    }
    ?>
</head>
<body
>

<!-- โชว์ข้อมูล -->
<br><br>
<?php
$id=isset($_GET['id']) ? $_GET['id']:'';
$date=isset($_GET['date']) ? $_GET['date']:'';
$document_number=isset($_GET['document_number']) ? $_GET['document_number']:'';

if($id!=''){ 
	$sql  = "SELECT * FROM receipt where ID='$id'";
    $result = $conn->query($sql);
    $row=$result->fetch_assoc();
	}

    $sqlList  = "SELECT * FROM receipt where document_number='$document_number' AND date ='$date'";
    $resultList = $conn->query($sqlList);
?>
     <center>
         <label class="font-20">ใบเสร็จการรักษา</label>
     </center>
         
<div>
    <table width="40%" border="0" class="font-16" style="margin-left: 25%" >
        <tr>
            <td align="right" valign="top">
                <label for="date" >วันที่ :</label><br>
                <label for="date" >เลขที่ใบเสร็จ :</label><br>
                <label for="name_customer" >ชื่อลูกค้า :</label><br>
                <label for="name_animals" >ชื่่อสัตว์เลี้ยง  :</label><br>
                <label for="tel_customer" >เบอร์โทรเจ้าของสัตว์เลี้ยง :</label><br>
                <label for="name_caretaker" >ชื่อผู้ดูแล :</label><br>
                <label for="tel_caretaker" >เบอร์โทรผู้ดูแล :</label>
            </td>
            <td valign="top" style="padding-left: 1%">
                <label><?php echo $row["date"];?></label><br>
                <label><?php echo $row["document_number"];?></label><br>
                <label><?php echo $row["name_customer"];?></label><br>
                <label><?php echo $row["tel_customer"];?></label><br>
                <label><?php echo $row["name_animals"];?></label><br>
                <label><?php echo $row["name_caretaker"];?></label><br>
                <label><?php echo $row["tel_caretaker"];?></label>
            </td>
        </tr>
    </table>

</div>
    <center>
        <br>
     <b class="font-18">รายการจ่ายยา</b> <br><br>
            <table width="98%" border="1" align="center" class="font-16">
                <tr>
                    <td width="20px"><center>ลำดับ</center></td>
                    <td width="200px"><center>รายการ</center></td>
                    <td width="40px"><center>จำนวน</center></td>
                    <td width="90px"><center>ราคา/หน่วย(บาท)</center></td>
                    <td width="50px"><center>จำนวนเงิน(บาท)</center></td>
                </tr>
                <?php
                    while($rowList = mysqli_fetch_assoc($resultList)) {
                    ?>
                    <tr>
                        <td align="center"><?php echo ($rowList["count"]) ?></td>
                        <td align="center"><?php echo ($rowList["txtList"]) ?></td>
                        <td align="center"><?php echo ($rowList["number"]) ?></td>
                        <td align="center"><?php echo ($rowList["price"]) ?></td>
                        <td align="center"><?php echo ($rowList["total"]) ?></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">รวมราคา</td>
                    <td align="center"><?php echo $row["txtCause"];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">ส่วนลด %</td>
                    <td align="center"><?php echo $row["discount"];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">&nbsp;ยอดคงเหลือ</td>
                    <td align="center"><?php echo $row["Balance"];?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">&nbsp;ยอดรวม</td>
                    <td align="center"><?php echo $row["TotalAll"];?></td>
                </tr>
            </table>
            </td>
            </tr>
            </table>
    </center>
     <br>
        <center>
    <br><br>
     <br><b class="font-14">ลงชื่อ...............................................ผู้รักษา
     <br><b style="color:#F00">ยืนยันจำนวนการรักษาสัตว์เลี้ยงของท่าน</b>
    <br><br><br><b>ลงชื่อ...............................................ผู้ดูแลการรักษา
     <br><br><b>วันที่........../.........../...........<br><br>
<input onclick="javascript:window.print()" type="image" src="../assets/images/print_icon.png"
width="80" height="80" name="print1" id="hid">
        </center>


<br><br><br><br>

<!-- ============================================================== -->
<!-- Jquery ทั้งหมด  -->
<!-- ============================================================== -->
<!-- ต้องมี -->
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ไม่ได้ใช้ที  ส่วนกำหนดค่า JavaScript ของ Core Bootstrap -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>

<!-- เมนูแถบด้านข้าง -->
<script src="../assets/dist/js/sidebarmenu.js"></script>
<!-- เปิด-ปิด Menu sidebar -->
<script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<!-- กำหนดเอง Scripts -->
<script src="../assets/dist/js/custom.min.js"></script>
</body>
</html>
