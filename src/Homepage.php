<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--  ให้รองรับและ แสดงหน้าตา ใน IE=edge ได้โดยไม่ผิดเพี้ยน-->
        <!-- กำหนดขนาด initial-scale=1.0 = เพื่อไม่ให้  Safari Zoom -->
        <meta name="viewport" content="width=device-width, initial-scale=1">  <!--  device-width = “ขนาด” ของ device นั้นๆ-->
        <meta name="description" content="">  <!--  บอกรายละเอียดของเว็บเพจแบบคร่าวๆ-->
        <meta name="author" content=""> <!-- ผู้เขียนหน้านี้ -->
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo.png">
        <title>Admin - Healthy Tracker</title>

        <!-- Custom CSS -->
        <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
        <link href="assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
        <link href="assets/dist/css/matrix-style.css" rel="stylesheet">
        <link href="assets/dist/css/style.min.css" rel="stylesheet">
        <link href="assets/dist/css/styleCommon.css" rel="stylesheet">
    </head>
    <?php
    include("Database/connect.php");
    $UserName = $_GET["UserName"];
    $sql = "SELECT * FROM admin WHERE user = '$UserName' ";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $sqlAllPostponement = "SELECT COUNT(*) as totalAllPostponement FROM postponement WHERE status = 'รออนุมัติ'";
    $queryAllPostponement = mysqli_query($conn, $sqlAllPostponement);
    $resultAllPostponement = mysqli_fetch_array($queryAllPostponement, MYSQLI_ASSOC);

    $Search = null;
    if(isset($_POST["txtSearch"]))
    {
        $Search = $_POST["txtSearch"];
    }

    $sqls = "SELECT * FROM member WHERE user LIKE '%".$Search."%' ";
    $querys = mysqli_query($conn, $sqls);

    ?>
    <body class="bg-container">
        <!-- ============================================================== -->
        <!-- ส่วนหัว - ใช้ style จาก pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            <?php require_once 'Component/HeaderHome.php';?>
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- ส่วน Title-->
                <!-- ============================================================== -->
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">หน้าหลัก</h4>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- ส่วนของปุ่มเมนู  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <center>
                        <div class="row" style="justify-content: center; align-content: center">
                            <div class="quick-actions_homepage  m-b-10">
                                <ul class="quick-actions">
                                    <li class="bg_lb" style="width: 18%; margin-left: 10%">
                                        <a href="Homepage.php?UserName=<?php echo($_GET["UserName"]); ?>">
                                            <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                            <div>My Dashboard</div>
                                        </a>
                                    </li>
                                    <li class="bg_ls" style="width: 18%;">
                                        <a href="ProfileUser/UserInformation.php?UserName=<?php echo($_GET["UserName"]); ?>">
                                            <h1 class="font-light text-white"><i class="fa fa-user-circle"></i></h1>
                                            <div style="margin-top: 10%">แจ้งการรักษา</div>
                                        </a>
                                    </li>
                                    <li class="bg_lo" style="width: 18%">
                                        <a href="Manage_User/ManageMembers.php?UserName=<?php echo($_GET["UserName"]); ?>">
                                            <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                                            <div>แจ้งการนัดพบ</div>
                                        </a>
                                    </li>
                                    <li class="bg_lg" style="width: 18%">
                                        <a href="Statistics_App/UserStatisticsApp.php?UserName=<?php echo($_GET["UserName"]); ?>">
                                            <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                            <div>การขอเลื่อนนัด</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <form name="search" method="post">
                            <table width="80%" border="0">
                                <tr>
                                    <th>
                                        <div align="center" class="font-16"> ชื่อผู้ใช้ :
                                            <input name="txtSearch" type="text" id="txtSearch" value="<?php echo($Search); ?>" />
                                            <input type="submit" value="ค้นหา" />
                                        </div>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </center>
                    <font  class="font-18" style="margin-top: 20px">รายชื่อผู้ทำการรักษาสัตว์เลี้ยง</font>
                    <table width="100%" border="1" style="margin-top: 10px; border: black;" class="font-14">
                        <tr bgcolor="#d6913a" style="color: white; height: 40px">
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ลำดับ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อผู้ใช้ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> รูปภาพสัตว์เลี้ยง </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อสัตว์เลี้ยง </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> เพศสัตว์เลี้ยง </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> วันเกิดสัตว์เลี้ยง </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> สายพันธุ์สัตว์เลี้ยง </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> สัตวแพทย์ที่รับผิดชอบ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> เบอร์โทรศัพท์สัตวแพทย์ </div>
                            </th>
                        </tr>

                        <?php
                        $x = 0;
                        $users = '';

                        $Responsible = $result["name"];
                        $status = $result["Status"];

                        while($result = mysqli_fetch_array($querys, MYSQLI_ASSOC))
                        {
                            $x = $x + 1;
                            $users = $result["user"];

                            $sqlResponsible = "SELECT * FROM sledging WHERE user = '$users' AND Responsible = '$Responsible' LIMIT 1 ";
                            $queryResponsible = mysqli_query($conn, $sqlResponsible);
                            $resultResponsible = mysqli_fetch_array($queryResponsible, MYSQLI_ASSOC);

                            ?>
                            <tr>
                                <td align="center" style="width: 5%"><?php echo ($x) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($result["user"]) ?></td>
                                <td align="center" style="width: 8%">
                                    <img src="<?php echo ($result["picAnimal"]) ?>" width="80" height="80" style="margin: 3% 0px 3% 0px;" >
                                </td>
                                <td align="center" style="width: 10%"><?php echo ($result["nameAnimal"]) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($result["sexAnimal"]) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($result["birthAnimal"]) ?></td>
                                <td align="center" style="width: 12%"><?php echo ($result["breedAnimal"]) ?></td>
                                <td align="center" style="width: 15%"><?php echo ($resultResponsible["Responsible"]) ?></td>
                                <td align="center" style="width: 10%"><?php echo ($resultResponsible["phoneVeterinary"]) ?></td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>

                    <?php
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <?php require_once 'Component/footer.php';?>
        </div>

        <!-- ============================================================== -->
        <!-- Jquery ทั้งหมด  -->
        <!-- ============================================================== -->
        <!-- ต้องมี -->
        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- ไม่ได้ใช้ที  ส่วนกำหนดค่า JavaScript ของ Core Bootstrap -->
        <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>

        <!-- เมนูแถบด้านข้าง -->
        <script src="assets/dist/js/sidebarmenu.js"></script>
        <!-- เปิด-ปิด Menu sidebar -->
        <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>

        <!-- กำหนดเอง Scripts -->
        <script src="assets/dist/js/custom.min.js"></script>
        <script src="assets/dist/js/scriptCustom.js"></script>

    </body>
    <?php
    mysqli_close($conn);
    ?>
</html>