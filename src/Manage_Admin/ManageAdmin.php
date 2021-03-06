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

    <!-- Custom CSS -->
    <link href="../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="../assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="../assets/dist/css/style.min.css" rel="stylesheet">
    <link href="../assets/dist/css/styleCommon.css" rel="stylesheet">

    <title>ฐานข้อมูล สัตวแพทย์</title>

</head>

<body class="bg-container">
    <?php
        $Search = null;
        if(isset($_POST["txtSearch"]))
        {
            $Search = $_POST["txtSearch"];
        }

        include('../Database/connect.php');

        $sql = "SELECT * FROM admin WHERE user LIKE '%".$Search."%' AND Status = 'admin' OR name LIKE '%".$Search."%' AND Status = 'admin'";
        $query = mysqli_query($conn, $sql);

        $UserName = $_GET["UserName"];
        $sqlmanage = "SELECT * FROM admin WHERE user = '$UserName'";
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
        <?php require_once '../Component/Header.php';?>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- ส่วน Title-->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ฐานข้อมูล สัตวแพทย์</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- ส่วนของเนื้อหา  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <center>
                    <form name="search" method="post">
                        <table width="80%" border="0">
                            <tr>
                                <th> <div align="center" class="font-16"> ชื่อผู้ใช้ หรือ ชื่อสัตวแพทย์ :
                                        <input name="txtSearch" type="text" id="txtSearch" value="<?php echo($Search); ?>" />
                                        <input type="submit" value="ค้นหา" />
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </form>
                </center>
                <button type="submit" name="Submit" class="font-16"
                        style="width: 10%; height: 30px; color: white; background: #f5b57f; border-color: white; margin-top: 2%"
                        onclick="window.location.href='api/insert.php?UserName=<?php echo($_GET["UserName"]); ?>'"
                >
                    เพิ่มข้อมูล
                </button>
                <center>
                    <table width="100%" border="1" style="margin-top: 20px; border: black;" class="font-14">
                        <tr bgcolor="#d6913a" style="color: white; height: 40px">
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ลำดับ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อผู้ใช้ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> รูปโปร์ไฟล์ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> อีเมล </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> รหัสผ่าน </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อ-นามสกุล </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> เบอร์โทรศัทพ์ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> สถานะผู้ใช้ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> วันที่สมัคร </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> การอนุญาต </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> แก้ไข </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ลบ </div>
                            </th>
                        </tr>

                        <?php
                        $x = 0;
                        while($result = mysqli_fetch_array($query, MYSQLI_ASSOC))
                        {
                            $x = $x + 1;
                            ?>
                            <tr>
                                <td align="center" style="width: 5%"><?php echo ($x) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($result["user"]) ?></td>
                                <td align="center" style="width: 9%; "><img src="<?php echo ($result["pic"]) ?>" width="90" height="80" style="margin: 3% 0px 3% 0px;"  ></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["email"]) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($result["password"]) ?></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["name"]) ?></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["phone"]) ?></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["Status"]) ?></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["DateRegis"]) ?></td>
                                <td align="center" style=" padding: 0.2%"><?php echo ($result["Permission"]) ?></td>
                                <td align="center" style="width: 5%; padding: 0.2%">
                                    <a href="api/edit.php?AdminID=<?php echo ($result["id"]);?>&UserName=<?php echo($_GET["UserName"]); ?>"> Edit </a>
                                </td>
                                <td align="center" style="width: 5%; padding: 0.2%">
                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true)
                    {window.location='api/delete.php?AdminID=<?php echo ($result["id"]);?>&UserName=<?php echo($_GET["UserName"]); ?>';}"> Delete </a>
                                </td>
                            </tr>


                            <?php
                        }
                        ?>
                    </table>
                </center>
                <?php
                mysqli_close($conn);
                ?>
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

</body>
</html>