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
    <title>การขออนุญาต</title>

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
        $Search = null;
        if(isset($_POST["txtSearch"]))
        {
            $Search = $_POST["txtSearch"];
        }

        include('../Database/connect.php');

        $sql = "SELECT * FROM adminmanage WHERE UserName LIKE '%".$Search."%' ";
        $query = mysqli_query($conn, $sql);

        $UserName = $_GET["UserName"];
        $sqlmanage = "SELECT * FROM adminmanage WHERE UserName = '$UserName' ";
        $querymanage = mysqli_query($conn, $sqlmanage);
        $resultUser = mysqli_fetch_array($querymanage, MYSQLI_ASSOC);

        $sqlProblemapp = "SELECT COUNT(*) as totalProblemapp FROM problemapp where Status != 'แก้ไขสร็จสิ้น' ";
        $queryProblemapp = mysqli_query($conn, $sqlProblemapp);
        $resultProblemapp = mysqli_fetch_array($queryProblemapp, MYSQLI_ASSOC);

        $sqlAdminmanage = "SELECT COUNT(*) as totalAdminmanage FROM adminmanage WHERE Permission = 'pending' ";
        $queryAdminmanage = mysqli_query($conn, $sqlAdminmanage);
        $resultAdminmanage = mysqli_fetch_array($queryAdminmanage, MYSQLI_ASSOC);
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
                        <h4 class="page-title">การขออนุญาต</h4>
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
                                <th> <div align="center" class="font-16"> ชื่อผู้ใช้ :
                                        <input name="txtSearch" type="text" id="txtSearch" value="<?php echo($Search); ?>" />
                                        <input type="submit" value="ค้นหา" />
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </form>
                    <div class="container-fluid m-t-10">
                        <div class="col-md-12 card card-body">
                            <div class="row" style="width: 100%; margin-left: 4%">
                                <?php
                                while($result = mysqli_fetch_array($query, MYSQLI_ASSOC))
                                {
                                    ?>
                                    <div class="cardID m-r-20 m-t-10 p-t-5" style="width: 17%;" >
                                        <center>
                                            <img src="<?php echo ($result["ImgProfile"]) ?>" width="90%" height="130px" style="margin-top: 3%;">
                                            <div class="containerID">
                                                <font class="font-20"><b><?php echo ($result["UserName"]) ?></b></font>
                                                <div>
                                                    <font class="font-16">สถานะ :</font>
                                                    <font class="font-14">
                                                        <?php
                                                            if($result["Permission"] === 'allow'){
                                                                echo ('อนุญาต');
                                                            }else if($result["Permission"] === 'disallow'){
                                                                echo ('ไม่อนุญาต');
                                                            }else{
                                                                echo ('รออนุญาต');
                                                            }
                                                        ?>
                                                    </font>
                                                </div>
                                                <div class="row justify-content-between align-items-center m-b-5" >
                                                    <form name="edit" action="api/updated.php?UserName=<?php echo($_GET["UserName"]); ?>" method="post" enctype="multipart/form-data" >
                                                        <input type="hidden" name="UserID" value="<?php echo ($result["ID"]);?>"/>
                                                        <input type="hidden" name="Permission" value="allow" />
                                                        <button  class="font-12" style=" color: white; background: #068e81;">
                                                            อนุญาต
                                                        </button>
                                                    </form>
                                                    <form name="edit" action="api/updated.php?UserName=<?php echo($_GET["UserName"]); ?>" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="UserID" value="<?php echo ($result["ID"]);?>" />
                                                        <input type="hidden" name="Permission" value="disallow" />
                                                        <button  class="font-12" style=" color: white; background: #068e81;">
                                                            ไม่อนุญาต
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
            <?php
            mysqli_close($conn);
            ?>
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