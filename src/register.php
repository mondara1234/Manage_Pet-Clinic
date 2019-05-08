<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!--  ให้รองรับและ แสดงหน้าตา ใน IE=edge ได้โดยไม่ผิดเพี้ยน-->
    <!-- กำหนดขนาด initial-scale=1.0 = เพื่อไม่ให้  Safari Zoom -->
    <meta name="viewport" content="width=device-width, initial-scale=1">  <!--  device-width = “ขนาด” ของ device นั้นๆ-->
    <meta name="description" content="">  <!--  บอกรายละเอียดของเว็บเพจแบบคร่าวๆ-->
    <meta name="author" content=""> <!-- ผู้เขียนหน้านี้ -->
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/logo.png">

    <!-- Custom CSS -->
    <link href="./assets/dist/css/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet">
    <link href="./assets/dist/css/style.min.css" rel="stylesheet">
    <link href="./assets/dist/css/styleCommon.css" rel="stylesheet">
	<title> สมัครผู้ดูแลระบบ </title>
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }
    </style>
</head>
<body style="background-image: url('./assets/images/background/bg_web.jpg'); background-size: 100% 100%;">
    <form name="add" method="post" action="./Database/InsertAdmin.php" enctype="multipart/form-data" target="iframe_target">
        <iframe id="iframe_target" name="iframe_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
        <div
                class="row justify-content-between"
                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%"
        >
            <div >
            </div>
            <div>
                <p style="margin-left: 15%; margin-top: -20%">
                    <font color="black" style="font-size: 40px;">ลงทะเบียน</font>
                </p>
                <table cellpadding="5">
                    <tr>
                        <td align="right" class="font-18" style="color: black">ชื่อผู้ใช้ :</td>
                        <td> <input name="txtUsername" type="text" id="txtUsername" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">อีเมล :</td>
                        <td> <input name="txtEmail" type="email" id="txtEmail" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">รหัสผ่าน :</td>
                        <td> <input name="txtPassword" type="password" id="txtPassword" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">ยืนยันรหัสผ่าน :</td>
                        <td> <input name="txtConfirmPassword" type="password" id="txtConfirmPassword" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">ชื่อ - นามสกุล :</td>
                        <td> <input name="txtFirst_name" type="text" id="txtFirst_name" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">เบอร์โทรศัพท์ :</td>
                        <td> <input name="txtTelephone" type="number" id="txtTelephone" maxlength="10" required> </td>
                    </tr>
                    <tr>
                        <td align="right" class="font-18" style="color: black">รูปโปรไฟล์ :</td>
                        <td> <input name="txtImgProfile" type="file" id="txtImgProfile" style="color: black" required> </td>
                    </tr>
                    <input type="hidden" name="date" id="date" value="<?php echo date('Y-m-d');?>"/>
                </table>
                <div  style="margin-left: 20%; margin-top: 5%">
                    <button type="submit" name="Submit" class="font-18"
                            style="width: 60%; height: 40px; color: white; background: #f5b57f; border-color: white"
                    >
                        ลงทะเบียน
                    </button>
                </div>
                <div style="margin-left: 20%; margin-top: 5%">
                    <label class="font-16" style="color: black">คุณมีบัญชีหรือยัง ?</label>
                    <a href="../index.html" class="font-18" style="margin-left: 5%; color: #ff8000">Login</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>