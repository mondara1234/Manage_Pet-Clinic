<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--  ให้รองรับและ แสดงหน้าตา ใน IE=edge ได้โดยไม่ผิดเพี้ยน-->
    <!-- กำหนดขนาด initial-scale=1.0 = เพื่อไม่ให้  Safari Zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--  device-width = “ขนาด” ของ device นั้นๆ-->
    <meta name="description" content="">  <!--  บอกรายละเอียดของเว็บเพจแบบคร่าวๆ-->
    <meta name="author" content=""> <!-- ผู้เขียนหน้านี้ -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/logo.png">

    <!-- Custom CSS -->
    <link href="../../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="../../assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../../assets/dist/css/style.min.css" rel="stylesheet">
    <link href="../../assets/dist/css/styleCommon.css" rel="stylesheet">
    <title> การเพิ่มข้อมูล สัตวแพทย์ </title>
</head>
<body class="bg-container">
<?php
include("../../Database/connect.php");

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
<!-- ============================================================== -->
<!-- ส่วนหัว - ใช้ style จาก pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <?php require_once '../../Component/HeaderEdit.php';?>
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- ส่วน Title-->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">การเพิ่มข้อมูล สัตวแพทย์</h4>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- ส่วนของเนื้อหา  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <center>
                <form name="edit" action="InsertAdmin.php" method="post" enctype="multipart/form-data" target="iframe_target">
                    <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                    <table width="70%" border="1" style="border: #d6913a double 5px;">
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> ชื่อผู้ใช้ :</b></td>
                            <td width="80%"><input type="text" name="txtUsername" style="width: 100%" required/></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> อีเมล :</b></td>
                            <td width="80%"><input type="email" name="txtEmail" style="width: 100%" required/></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> รหัสผ่าน :</b></td>
                            <td width="80%"><input type="password" name="txtPassword" style="width: 100%" required/></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> ชื่อ - นามสกุล :</b></td>
                            <td width="80%"><input type="text" name="txtFirst_name" style="width: 100%" required/></td>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> เบอร์โทรศัพท์ :</b></td>
                            <td width="80%"><input type="number" name="txtTelephone"  style="width: 100%" required/></td>
                            <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d');?>"/>
                        </tr>
                        <tr>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> การอนุญาตใช้งาน :</b></td>
                            <td width="80%">
                                <select name="Permission" id="Permission">
                                    <option value="allow" selected>อนุญาต</option>
                                    <option value="disallow" >ไม่อนุญาต</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d');?>"/>
                            <td width="20%" align="right"><b style="margin-right: 2%;"> รูปโปรไฟล์ :</b></td>
                            <td width="80%">
                                <input type="file" name="pImgProfile" id="pImgProfile"/>
                            </td>
                        </tr>
                    </table>
                    <button type="submit" name="Submit" class="font-18"
                            style="width: 20%; height: 40px; color: white; background: #f5b57f; border-color: white; margin-top: 2%"
                    >
                        เพิ่มข้อมูล
                    </button>
                </form>
            </center>
            <?php
            mysqli_close($conn);
            ?>
        </div>
    </div>
    <?php require_once '../../Component/footer.php';?>
</div>
<!-- ============================================================== -->
<!-- Jquery ทั้งหมด  -->
<!-- ============================================================== -->
<!-- ต้องมี -->
<script src="../../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ไม่ได้ใช้ที  ส่วนกำหนดค่า JavaScript ของ Core Bootstrap -->
<script src="../../assets/libs/popper.js/dist/umd/popper.min.js"></script>

<!-- เมนูแถบด้านข้าง -->
<script src="../../assets/dist/js/sidebarmenu.js"></script>
<!-- เปิด-ปิด Menu sidebar -->
<script src="../../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<!-- กำหนดเอง Scripts -->
<script src="../../assets/dist/js/custom.min.js"></script>
</body>
</html>