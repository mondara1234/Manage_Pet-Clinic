
<!-- Sidebar scroll-->
<aside class="left-sidebar " data-sidebarbg="skin5">
    <nav class="sidebar-nav ">
        <ul id="sidebarnav" class="p-t-30">
            <?php if($resultUser["Status"] === "admin"): ?>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../Homepage.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">หน้าหลัก</span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Treatment/Treatment.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="fa fa-user-md"></i>
                        <span class="hide-menu p-r-10"> แจ้งการรักษา </span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Statistics_App/UserStatisticsApp.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="hide-menu p-r-10"> แจ้งการนัดพบ </span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Problems/Problems.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-alert"></i>
                        <span class="hide-menu p-r-10"> การขอเลื่อนนัด </span>
                        <span class="label label-danger"><?php echo($resultAllPostponement['totalAllPostponement']); ?></span>
                    </a>
                </li>
            <?php elseif($resultUser["Status"] === "superadmin"): ?>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../Homepage.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">หน้าหลัก</span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link has-arrow waves-effect" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-pencil"></i>
                        <span class="hide-menu"> การจัดการฐานข้อมูล </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item font-14">
                            <a href="../../Manage_User/ManageMembers.php?UserName=<?php echo($_GET["UserName"]); ?>" class="sidebar-link">
                                <i class="fa fa-user-plus"></i>
                                <span class="hide-menu"> ฐานข้อมูล สมาชิก </span>
                            </a>
                        </li>
                        <li class="sidebar-item font-14">
                            <a href="../../Manage_history/Managehistory.php?UserName=<?php echo($_GET["UserName"]); ?>" class="sidebar-link">
                                <i class="mdi mdi-book-open-page-variant"></i>
                                <span class="hide-menu"> ฐานข้อมูล ประวัติการรักษา </span>
                            </a>
                        </li>
                        <li class="sidebar-item font-14">
                            <a href="../../Manage_sledging/Managesledging.php?UserName=<?php echo($_GET["UserName"]); ?>" class="sidebar-link">
                                <i class="mdi mdi-engine-outline"></i>
                                <span class="hide-menu"> ฐานข้อมูล การนัดพบ</span>
                            </a>
                        </li>
                        <li class="sidebar-item font-14">
                            <a href="../../Manage_postponement/Managepostponement.php?UserName=<?php echo($_GET["UserName"]); ?>" class="sidebar-link">
                                <i class="mdi mdi-food"></i>
                                <span class="hide-menu"> ฐานข้อมูล การขอเลื่อนนัด </span>
                            </a>
                        </li>
                        <li class="sidebar-item font-14">
                            <a href="../../Manage_Admin/ManageAdmin.php?UserName=<?php echo($_GET["UserName"]); ?>" class="sidebar-link">
                                <i class="mdi mdi-run-fast"></i>
                                <span class="hide-menu"> ฐานข้อมูล ผู้ดูแลระบบ </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Treatment/Treatment.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="fa fa-user-md"></i>
                        <span class="hide-menu p-r-10"> แจ้งการรักษา </span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Statistics_App/UserStatisticsApp.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-chart-bar"></i>
                        <span class="hide-menu p-r-10"> แจ้งการนัดพบ </span>
                    </a>
                </li>
                <li class="sidebar-item font-14">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../../../src/Problems/Problems.php?UserName=<?php echo($_GET["UserName"]); ?>" aria-expanded="false">
                        <i class="mdi mdi-alert"></i>
                        <span class="hide-menu p-r-10"> การขอเลื่อนนัด </span>
                        <span class="label label-danger"><?php echo($resultAllPostponement['totalAllPostponement']); ?></span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
<header class="topbar " data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- เป็นการสลับแถบด้านข้างจะแสดงเพียงบนโทรศัพท์ -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <!-- ============================================================== -->
            <!-- ส่วนหัวข้อแถบเมนู -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="../Homepage.php?UserName=<?php echo($_GET["UserName"]); ?>">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <img src="../../assets/images/logo.png" alt="homepage" height="50" width="50" class="light-logo" />
                </b>
                <!-- Logo text -->
                <span class="logo-text">
                            <div class="light-logo" style="font-size: 20px;" > Manage Pet Clinic </div>
                        </span>
            </a>
            <!-- ============================================================== -->
            <!-- สลับที่มองเห็นได้เฉพาะบนอุปกรณ์เคลื่อนที่เท่านั้น -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- กรอบทางช้าย -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="mdi mdi-menu font-24"></i>
                    </a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- กรอบทางขวา -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- ส่วนของรูป user  -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="<?php echo ($resultUser["pic"]) ?>" alt="user" width="40" >
                        <span class="font-16 m-r-5 m-l-5"><?php echo ($resultUser["user"]) ?></span>
                        <span class=" fa fa-angle-down font-16"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../EditProfile/edit_Profile.php?UserName=<?php echo($_GET["UserName"]); ?>"><i class="ti-user m-r-5 m-l-5"></i> ข้อมูลส่วนตัว </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../Database/logout.php"><i class="fa fa-power-off m-r-5 m-l-5"></i> ออกจากระบบ </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>