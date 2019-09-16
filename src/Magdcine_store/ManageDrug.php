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
        <title>Admin - Pet-Clinic</title>

        <!-- Custom CSS -->
        <link href="../assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
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
        $sql = "SELECT * FROM store_drug WHERE name LIKE '%".$Search."%' OR name_Owner LIKE '%".$Search."%'";
    }else{
        $sqlAllPostponement = "SELECT COUNT(*) as totalAllPostponement FROM postponement WHERE status = 'รออนุมัติ' AND Responsible = '$name'";
        $queryAllPostponement = mysqli_query($conn, $sqlAllPostponement);
        $resultAllPostponement = mysqli_fetch_array($queryAllPostponement, MYSQLI_ASSOC);
        $sql = "SELECT * FROM store_drug WHERE name LIKE '%".$Search."%' AND name_Owner = '$name' ";
    }

    $query = mysqli_query($conn, $sql);
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
                        <h4 class="page-title">คลังยา</h4>
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
                                <th> <div align="center" class="font-16"> ชื่อยา หรือ ชื่อเจ้าของยา :
                                        <input name="txtSearch" type="text" id="txtSearch" value="<?php echo($Search); ?>" />
                                        <input type="submit" value="ค้นหา" />
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </form>
                </center>
                <button type="submit" name="Submit" class="font-16"
                        style="width: 10%; height: 30px; color: white; background: #d6913a; border-color: white; margin-top: 2%"
                        onclick="window.location.href='api/insert.php?UserName=<?php echo($_GET["UserName"]); ?>'"
                >
                    เพิ่มข้อมูลยา
                </button>
                <center>
                    <table width="100%" border="1" style="margin-top: 20px; border: black;" class="font-14">
                        <tr bgcolor="#d6913a" style="color: white; height: 40px">
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ลำดับ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อยา </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> รูปยา </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> สรรพคุณ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> จำนวนคงเหลือ </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ราคา/หน่วย </div>
                            </th>
                            <th style="padding-left: 5px; padding-right: 5px">
                                <div align="center"> ชื่อเจ้าของยา </div>
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
                                <td align="center" style="width: 3%"><?php echo ($x) ?></td>
                                <td align="center" style="width: 12%"><?php echo ($result["name"]) ?></td>
                                <td align="center" style="width: 8%; height: 100px;"><img src="<?php echo ($result["img"]) ?>" width="100%" height="100%"  ></td>
                                <td align="center" style="width: 25%; "><textarea rows="5" style="width: 100%; resize: none;"  readonly><?php echo ($result["properties"]) ?></textarea></td>
                                <td align="center" style="width: 10%; "><?php echo ($result["total"]) ?></td>
                                <td align="center" style="width: 8%; "><?php echo ($result["price"]) ?></td>
                                <td align="center" style="width: 15%; "><?php echo ($result["name_Owner"]) ?></td>
                                <td align="center" style="width: 4%; padding: 0.2%">
                                    <a href="api/edit.php?DrugID=<?php echo ($result["ID"]);?>&UserName=<?php echo($_GET["UserName"]); ?>"> Edit </a>
                                </td>
                                <td align="center" style="width: 4%;">
                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true)
                    {window.location='api/delete.php?DrugID=<?php echo ($result["ID"]);?>&UserName=<?php echo($_GET["UserName"]); ?>';}"> Delete </a>
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