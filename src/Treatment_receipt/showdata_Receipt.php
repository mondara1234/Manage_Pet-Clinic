<?php
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

    <?php
    include('../Database/connect.php');

    $Search = null;
    if(isset($_POST["txtSearch"]))
    {
        $Search = $_POST["txtSearch"];
    }

    $sql  = "SELECT * FROM receipt WHERE name_customer LIKE '%".$Search."%' OR name_caretaker LIKE '%".$Search."%' OR date LIKE '%".$Search."%' OR document_number LIKE '%".$Search."%' ";


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
<body class="bg-container">
<div id="main-wrapper">
    <?php require_once '../Component/Header.php';?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">ประวัติการออกใบเสร็จ</h4>
                </div>
            </div>
        </div>
<!-- โชว์ข้อมูล -->
<br><br>
<div class="container" style="margin-bottom: 3%">
    <center>
        <form name="search" method="post">
            <table width="100%" border="0">
                <tr>
                    <th>
                        <div align="center" class="font-16"> ชื่อเจ้าของสัตว์เลี้ยง หรือ ชื่อผู้ดูแล หรือ วันที่ หรือ เลขที่ใบเสร็จ :
                            <input name="txtSearch" type="text" id="txtSearch" value="<?php echo($Search); ?>" />
                            <input type="submit" value="ค้นหา" />
                        </div>
                    </th>
                </tr>
            </table>
        </form>
    </center>
</div>
<div class="container">
<table class="table table-bordered font-16" style="margin-bottom: 3%">
  <thead>
    <tr align="center">
        <th scope="col" >เลขที่ใบเสร็จ</th>
      <th scope="col" >ชื่อผู้ดูแล</th>
      <th scope="col" >วันที่</th>
      <th scope="col" >ชื่อลูกค้า</th>
	  <th scope="col" >ค่ารักษา</th>
      <th scope="col" >ลบ</th>
      <th scope="col" >พิมพ์</th>
    </tr>
  </thead>
<?php

$result = $conn->query($sql);
if($result->num_rows>0){
	$checkName ='';
	while($row=$result->fetch_assoc()){ 
if($checkName === $row["document_number"]): ?>
 <?php else : $checkName = $row["document_number"]; ?>
  <tbody align="center">
    <tr>
        <td><?php echo $row["document_number"];?></td>
      <td><?php echo $row["name_caretaker"];?></td>
      <td><?php echo $row["date"];?></td>
      <td><?php echo $row["name_customer"];?></td>
      <td><?php echo $row["TotalAll"];?></td>
      <td><a href="deletedata_Receipt.php?document_number=<?php echo $row['document_number'];?>&UserName=<?php echo($_GET["UserName"]); ?>">
          <button type="button" class="btn btn-danger">ลบ</button></a></td>
          <td><a href="print_Receipt.php?id=<?php echo $row ['ID'];?>&document_number=<?php echo $row ["document_number"];?>&date=<?php echo $row ["date"];?>&UserName=<?php echo($_GET["UserName"]); ?>">
          <button type="button" class="btn btn-info">พิมพ์</button></a></td> 
    </tr>
    </tr>
    <?php endif ;?>
<?php
	}
	  }else{
	  echo "0 row";
	  }
    $conn->close();
?>
  </tbody>
</table>
</div>

    </div>
    <?php require_once '../Component/footer.php';?>
</div>

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
</body>
</html>
