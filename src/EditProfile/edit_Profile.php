<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--  ให้รองรับและ แสดงหน้าตา ใน IE=edge ได้โดยไม่ผิดเพี้ยน-->
    <!-- กำหนดขนาด initial-scale=1.0 = เพื่อไม่ให้  Safari Zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--  device-width = “ขนาด” ของ device นั้นๆ-->
    <meta name="description" content="">  <!--  บอกรายละเอียดของเว็บเพจแบบคร่าวๆ-->
    <meta name="author" content=""> <!-- ผู้เขียนหน้านี้ -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/logo.png">
    <title>แก้ไขข้อมูลส่วนตัว</title>

    <!-- Custom CSS -->
    <link href="../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="../assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../assets/dist/css/matrix-style.css" rel="stylesheet">
    <link href="../assets/dist/css/style.min.css" rel="stylesheet">
    <link href="../assets/dist/css/styleCommon.css" rel="stylesheet">

</head>
<body class="bg-container">
    <?php
    include("../Database/connect.php");
    $UserName = $_GET["UserName"];
    $sqlmanage = "SELECT * FROM admin WHERE user = '$UserName' ";
    $querymanage = mysqli_query($conn, $sqlmanage);
    $resultUser = mysqli_fetch_array($querymanage, MYSQLI_ASSOC);

    $sqlAllPostponement = "SELECT COUNT(*) as totalAllPostponement FROM postponement WHERE status = 'รออนุมัติ'";
    $queryAllPostponement = mysqli_query($conn, $sqlAllPostponement);
    $resultAllPostponement = mysqli_fetch_array($queryAllPostponement, MYSQLI_ASSOC);
    ?>
    <!-- ============================================================== -->
    <!-- ส่วนหัว - ใช้ style จาก pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <?php require_once '../Component/Header.php';?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- ส่วน Title-->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">แก้ไขข้อมูลส่วนตัว</h4>
                        <div class="ml-auto text-right" >
                            <div class="font-18" align="center">
                                <i class="fa fa-user " style="color: red"></i>
                                <font>สถานะผู้ใช้งาน</font>
                            </div>
                            <div class="font-16" align="center" style="color: red"><b><?php echo $resultUser["Status"]=== 'สัตวแพทย์' ? 'สัตวแพทย์' : 'ผู้ดูแลระบบ'; ?></b></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- ส่วนของเนื้อหา  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <form name="edit" action="api/updated.php?UserName=<?php echo($_GET["UserName"]); ?>" method="post" enctype="multipart/form-data" target="iframe_target">
                    <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                    <div class="row justify-content-between">
                        <div class="font-16" align="center" style="width: 60%; margin-left: 5%">
                            <div style="margin-left: -48%">
                                <font class="font-18">UserName :</font>
                                <input type="text" name="UserNameAD" value="<?php echo $resultUser["user"]; ?>" readonly>
                                <input type="hidden" name="UserID" value="<?php echo $resultUser["id"]; ?>">
                            </div>
                            <div class="m-t-10" style="margin-left: -27%">
                                <font class="font-18">Password :</font>
                                <input type="password" name="Password" value="<?php echo $resultUser["password"]; ?>">
                                <font class="font-14" style="color: red">(อย่างน้อย 6 ตัวขึ้นไป)</font>
                            </div>
                            <div class="m-t-10" style="margin-left: -42%">
                                <font class="font-18">Email :</font>
                                <input type="email" name="Email" value="<?php echo $resultUser["email"]; ?>">
                            </div>
                            <div class="m-t-10" style="margin-left: -51%">
                                <font class="font-18">ชื่อ - นามสกุล :</font>
                                <input type="text" name="FirstName" value="<?php echo $resultUser["name"]; ?>">
                            </div>
                            <div class="m-t-10" style="margin-left: -51%">
                                <font class="font-18">เบอร์โทรศัพท์ :</font>
                                <input type="number" name="Telephone" value="<?php echo $resultUser["phone"]; ?>">
                            </div>
                        </div>
                        <div align="center" class="font-14" style="width: 40%; margin-top: -2%; margin-left: -15%">
                            <div>
                                <img id="img" src="<?php echo ($resultUser["pic"]) ?>" width="100" height="100" style="margin: 3% 0px 3% 0px;" >
                            </div>
                            <input type="file" name="pImgProfile" style="margin-left: 20%" id="pImgProfile" onchange="onFileSelected(event)" />
                            <input type="hidden" name="ImgProfile" value="<?php echo $resultUser["pic"]; ?>">
                        </div>
                    </div>
                    <div align="center" style="margin-left: -5%; margin-top: 5%;">
                        <button type="submit" name="Submit" class="font-18"
                                style="width: 20%; height: 40px; color: white; background: #f5b57f; border-color: white; margin-top: 2%"
                        >
                            บันทึกการเปลี่ยนแปลง
                        </button>
                        <button type="button" name="ok" class="font-18 m-l-20"
                                style="width: 10%; height: 40px; color: white; background: #f5b57f; border-color: white; margin-top: 2%"
                                onclick="window.location.reload()"
                        >
                            ยกเลิก
                        </button>
                    </div>
                </form>
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
    <script src="../assets/dist/js/custom.min.js"></script>
    <script type="text/javascript">
        function onFileSelected(event) {
            let selectedFile = event.target.files[0];
            let reader = new FileReader();

            let imgtag = document.getElementById("img");
            imgtag.title = selectedFile.name;

            reader.onload = function(event) {
                imgtag.src = event.target.result;
            };

            reader.readAsDataURL(selectedFile);
        }
    </script>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>