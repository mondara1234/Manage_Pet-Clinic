<?php
date_default_timezone_set("Asia/Bangkok");
?>

<!doctype html>
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
  $x = $_POST["numberlist"];
    ?>
<script type="text/javascript">
    let sumtotal = 0; //คำนวณ ราคารวม
    let awsdiscount = 0;
    let Sumdiscount = 0;
    function calculate(count) {
        let total = 0;
        let number = parseInt(document.getElementById('number_' + count).value);
        let price = parseInt(document.getElementById('price_' + count).value);
        if ( isNaN(number) )
        {
            number = 0;
        }
        if ( isNaN(price) )
        {
            price = 0;
        }
        total = number * price ; //คำนวณราคาต่อช่อง

        let sum = 0; //คำนวณ ราคารวม
        let num = parseInt(<?php echo ($x);?>);
        for(let i=1; i<= num; i++){
            sum = sum + parseInt(document.getElementById('total_' + i).value ? document.getElementById('total_' + i).value : 0);
        }

        sumtotal = sum;
        document.getElementById('total_' + count).value = total;
        document.getElementById('txtCause').value = sum;
    }

    function discounts() {
        let discount = parseInt(document.getElementById('discount').value);
        awsdiscount = sumtotal * discount / 100;
        Sumdiscount = sumtotal - awsdiscount;//ค่าผลรวมหักจากส่วนลด

        let TotalAll = 0;
        TotalAll = Sumdiscount ;//หายอดรวมทั้งหมด

        document.getElementById('Balance').value = Sumdiscount ? Sumdiscount : 0;
        document.getElementById('TotalAll').value = TotalAll ? TotalAll : 0;
    }

    function click_btm_Quotation(){
        let countList = parseInt(<?php echo ($x);?>);
        let document_number = document.getElementById("document_number").value;
        let name_customer = document.getElementById("name_customer").value;
        let name_animals = document.getElementById("name_animals").value;
        let tel_customer = document.getElementById("tel_customer").value;
        let name_caretaker = document.getElementById("name_caretaker").value;
        let tel_caretaker = document.getElementById("tel_caretaker").value;
        let dateformat = document.getElementById("dateformat").value;
        let txtCause = document.getElementById("txtCause").value;
        let discount = document.getElementById("discount").value;
        let Balance = document.getElementById("Balance").value;
        let TotalAll = document.getElementById("TotalAll").value;

        for( let i=1 ; i<=countList ; i++)
        {
            let count = document.getElementById("count_"+i).value;
            let txtList = document.getElementById("txtList_"+i).value;
            let number = document.getElementById("number_"+i).value;
            let price = document.getElementById("price_"+i).value;
            let total = document.getElementById("total_"+i).value;
            $.ajax({
                type: "POST",
                url: "Insert_Receipt.php",
                data:  {
                    document_number: document_number,
                    name_customer: name_customer,
                    name_animals: name_animals,
                    tel_customer: tel_customer,
                    name_caretaker: name_caretaker,
                    tel_caretaker: tel_caretaker,
                    dateformat: dateformat,
                    count: count,
                    txtList: txtList,
                    number: number,
                    price: price,
                    total: total,
                    txtCause: txtCause,
                    discount: discount,
                    Balance: Balance,
                    TotalAll: TotalAll
                },
                success: function(result) {
                    console.log('Debug Objects: "'+result );
                    if(result === 'ss'){
                        if(confirm('บันทึกสำเร็จ')==true) {
                           window.location.href = "showdata_Receipt.php";
                        }else{
                            return false;
                        }
                    }else{
                        console.log(result);
                    }
                }
            });

        }
    }
</script>
</head>
<body class="bg-container">
<div id="main-wrapper">
    <?php require_once '../Component/Header.php';?>
    <div class="page-wrapper">
<!-- form -->
<br><br>
    <form name="formlist" method="post">
        <table width="90%" border="0" align="center" class="font-16">
          <tr>
            <td  align="center">
              <label class="font-20">ใบเสร็จการรักษา</label>
            </td>
          </tr>
          <tr>
            <td>
                <br>
               <table width="61%" border="0" class="font-16" style="margin-left: 19%" >
                 <tr>
                      <td align="right">
                          <label for="name_customer">ชื่อลูกค้า :</label><br>
                          <label for="name_animals">ชื่่อสัตว์เลี้ยง :</label><br>
                          <label for="tel_customer">เบอร์โทรลูกค้า :</label>
                      </td>
                     <td style="padding-left: 1%">
                         <input type="text" name="name_customer" id="name_customer" value="<?php echo $_POST['name_customer'] ?>" readonly><br>
                         <input type="text" name="name_animals" id="name_animals" value="<?php echo $_POST['name_animals'] ?>" readonly><br>
                         <input type="tel" name="tel_customer" id="tel_customer" value="<?php echo $_POST['tel_customer'] ?>" readonly>
                     </td>
                      <td align="right">
                          <label for="date">เลขที่ใบเสร็จ :</label><br>
                          <label for="date" >วันที่ :</label><br>
                          <label for="name_caretaker">ชื่อผู้ดูแล :</label><br>
                          <label for="tel_caretaker">เบอร์โทรผู้ดูแล :</label>

                      </td>
                     <td  style="padding-left: 1%">
                         <input type="text" name="document_number" id="document_number" value="<?php echo $_POST['document_number'] ?>" readonly><br>
                         <input type="text" name="date" id="date" value="<?php echo date('d-m-Y') ?>" readonly><br>
                         <input type="hidden" name="dateformat" id="dateformat" value="<?php echo date('Y-m-d') ?>" readonly>
                         <input type="text" name="name_caretaker" id="name_caretaker" value="<?php echo $_POST['name_caretaker'] ?>" readonly><br>
                         <input type="tel" name="tel_caretaker" id="tel_caretaker" value="<?php echo $_POST['tel_caretaker'] ?>" readonly>
                     </td>
                 </tr>
               </table>
            </td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="1" align="center" style="margin-top: 3%; " >
                    <tr>
                        <td width="10%"><center>ลำดับ</center></td>
                        <td width="20%"><center>รายการ</center></td>
                          <td width="20%"><center>จำนวน</center></td>
                        <td width="20%"><center>ราคา/หน่วย(บาท)</center></td>
                        <td width="20%"><center>จำนวนเงิน(บาท)</center></td>
                    </tr>
                    <?php
                    for($i=1; $i<=$x; $i++)
                    {
                        ?>
         <tr>
           <td ><input type="number" name="count_<?php echo $i ?>" id="count_<?php echo $i ?>" style="width: 100%" value="<?php echo $i ?>" readonly/></td>
           <td><input type="text" name="txtList_<?php echo $i ?>" id="txtList_<?php echo $i ?>" style="width: 100%"
                onkeyup="calculate(<?php echo $i ?>)" /></td>
           <td><input type="number" name="number_<?php echo $i ?>" id="number_<?php echo $i ?>" style="width: 100%"
                onkeyup="calculate(<?php echo $i ?>)" /></td>
           <td><input type="number" name="price_<?php echo $i ?>" id="price_<?php echo $i ?>" style="width: 100%"
                onkeyup="calculate(<?php echo $i ?>)" /></td>
           <td><input type="number" name="total_<?php echo $i ?>" id="total_<?php echo $i ?>" style="width: 100%" disabled /></td>
         </tr>
            <?php
              }
              ?>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td style="text-align:right">รวมราคา</td>
               <td><input type="text" name="txtCause" id="txtCause" value="" style="width: 100%" readonly/></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td style="text-align:right">ส่วนลด %</td>
               <td><input type="text" name="discount" id="discount" style="width: 100%" onkeyup="discounts()" /></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td style="text-align:right">&nbsp;ยอดคงเหลือ</td>
              <td><input type="text" name="Balance" id="Balance" value="" style="width: 100%"" readonly/></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align:right">&nbsp;ยอดรวม</td>
                <td><input type="text" name="TotalAll" id="TotalAll" style="width: 100%" readonly/></td>
            </tr>
                </table>
            </td>
          </tr>
        </table>
        <br><br>
        <center>
       <input type="button" name="submit" value="บันทึก" class="font-18" style=" height: 50px; margin-bottom: 4%" onclick="click_btm_Quotation();" >
       </center>
    </form>
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
