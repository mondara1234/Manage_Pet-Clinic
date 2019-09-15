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
    <title>Admin - Pet-Clinic</title>

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
    $year = (@date('Y')+543);
    $sqlAuto = "SELECT Max(document_number)+1 as MaxID FROM receipt  ";
    $queryAuto = mysqli_query($conn,$sqlAuto);
    $data = mysqli_fetch_assoc($queryAuto);
    $New_id = $data['MaxID'];
    if($New_id==""){
        $auto_number = $year."0001";
    }else{
        $auto_number = sprintf("%04d",$New_id);
    }

    ?>
</head>
<body class="bg-container">
<div id="main-wrapper">
    <?php require_once '../Component/Header.php';?>
    <div class="page-wrapper">
<!-- form -->
<br><br>
<div class="container">
<form action="Receipt.php?UserName=<?php echo($_GET["UserName"]); ?>" method="post" enctype="multipart/form-data" >
<table width="80%" border="0" align="center">
  <tr>
    <td  align="center">
     <label class="font-20">การระบุจำนวนรายการใบเสร็จ</label>
    </td>
  </tr>
  <tr>
    <td>
       <table width="100%" border="0" class="font-16"  >
         <tr>
          <td>
          <br>
             <label for="name_customer" style="margin-left: 25%">ชื่อเจ้าของสัตว์เลี้้ยง :</label><br>
              <label for="address" style="margin-left: 50%">ชื่่อสัตว์เลี้ยง :</label><br>
             <label for="tel_customer" style="margin-left: 6%">เบอร์โทรเจ้าของสัตว์เลี้ยง :</label>
          </td>
             <td>
                 <input type="text" name="name_customer" style="margin-top: 9%" required><br>
                 <input type="text" class="font-16" name="name_animals" required><br>
                 <input type="tel" name="tel_customer" required>
             </td>
          <td>
              <label for="numbergas" style="margin-left: 15%">เลขที่ใบเสร็จ :</label><br>
              <label for="numbergas" style="margin-left: 36%">ชื่อผู้ดูแล :</label><br>
              <label for="brandcar" style="margin-left: 5%">เบอร์โทรผู้ดูแล :</label>
          </td>
             <td>
                 <input type="text" name="document_number" style="margin-top: -5%" onkeyup=*if(this.value*1!=this.value) this.value="";* value="<?php echo $auto_number ?>" readonly><br>
                 <input type="text" name="name_caretaker" required><br>
                 <input type="tel" name="tel_caretaker" required>
             </td>
         </tr>
       </table>
        <br><center>
        <label for="date" class="font-18" style="margin-top: 3%"> กรุณากรอกจำนวนช่องรายการที่ต้องการก่อน </label> <br><br>
       <input type="text" class="font-16" name="numberlist" style="width: 300px; height: 40px"><br><br>
          <input type="submit" name="submit" class="font-18" style=" height: 50px; margin-bottom: 30%" value="สร้างใบเสร็จการรักษา">
          </center>
       </td>
      </tr>
</table>
</form>

</div>
    </div>
    <?php require_once '../Component/footer.php';?>
</div>


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
