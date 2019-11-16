<?
	include 'head.php';
?>

<?
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	
	
		if($_GET["action"] == "1"){

			$ORDER_ID = $_GET["order_id"];
	
			$stat = $_GET["stat"];
			
			
			$sql = "UPDATE  order_magic SET STATUS='$stat'  WHERE ORDER_ID ='$ORDER_ID'";
			

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New record created successfully";
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
			
		

		}
		
		if($_GET["action"] == "2"){

			$ORDER_ID = $_GET["order_id"];
	
			
			
			$sql = "UPDATE  order_magic SET DISC='จัดส่งแล้ว'  WHERE ORDER_ID ='$ORDER_ID'";
			

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New record created successfully";
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
			
		

		}
		
		if($_GET["action"] == "999"){

			$ORDER_ID = $_GET["order_id"];
	
			$disc = $_GET["disc"];
			
			
			$sql = "UPDATE  order_magic SET DISC='$disc'  WHERE ORDER_ID ='$ORDER_ID'";
			

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New record created successfully";
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
			
		

		}

?>
<div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>รายละเอียด ออเดอร์</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <!-- /. ROW  -->
				   <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
		
				  <div style="height:10px;"></div>
        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>รายการสั่งซื้อ</th>
                                            <th>จำนวน</th>
										
                                        </tr>
                                    </thead>
                                    <tbody>
<? 
// Create connection
	
		
		$sql = "SELECT a.ORDER_ID,a.ORDER_QTY , a.PRODUCT_ID, a.PRICE_SALE, a.PV, b.NAME ,b.PV FROM order_detail a, product b
				WHERE a.PRODUCT_ID = b.ID AND a.ORDER_ID ='".$_GET["order_id"]."'";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>									
                                        <tr>
                                            <td><? echo $i?></td>
                                            <td><? echo $row["NAME"] ?></td>
											<td>
											<? echo $row["ORDER_QTY"] ?>
											</td>
											
                                        </tr>
<? 
}

?>                                       
                                    </tbody>
                                </table>
								
								
<? 

		
		
		$sql = "SELECT * FROM order_magic
				WHERE ORDER_ID ='".$_GET["order_id"]."'";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>		

	ราคาทั้งหมด :<? echo $row["TOTAL_SALE"]; ?> บาท<br> 
	ชื่อลูกค้า : <? echo $row["USER_NAME"]; ?> <br> 
	ที่อยู่การจัดส่ง : <? echo $row["ADDR_ORDER"]; ?> <br> 
	เวลาการสั่งซื้อ : <? echo $row["INSERT_DATE"]; ?> <br> 

	<? 
		if($row["STATUS"] == "0"){ 
			echo "สถานะ: ยังไม่ได้ชำระเงิน <br>";
		}else{
			echo "สถานะ: ชำระเงินแล้ว <br>";
		}

	?>
	เปลี่ยนสถานะ : <input type="button" onclick="javascript:location.href='order_detail.php?order_id=<? echo $_GET["order_id"]; ?>&action=1&stat=1'" value="ชำระเงินแล้ว" > 
 : <input type="button" onclick="javascript:location.href='order_detail.php?order_id=<? echo $_GET["order_id"]; ?>&action=1&stat=0'" value="ยังไม่ชำระเงิน" > <br>	
 
	
	<form action="order_detail.php">
	เลขพัสดุ : <input type="text"  name="disc" value="<? echo $row["DISC"]; ?>" id="disc"  /> 
	<input type="hidden" name="action" value="999" />
	<input type="hidden" name="order_id" value="<? echo $_GET["order_id"]; ?>" />
	<input type="submit"  size="58"value="ยืนยัน" > <br> 
	</form>
	
<? 
}

?> 
<h1> ข้อมูลการชำระเงิน </h1>
<? 
// Create connection
	
		
		$sql = "SELECT * FROM alert_pay WHERE ORDER_ID = '".$_GET["order_id"]."'";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>	
		
			BANK : <? if($row["BANK"] == '2' ){ echo "ธ.กสิกรไทย"; }else if($row["BANK"] == '3'){  echo "ธ.กรุงเทพ"; }else if($row["BANK"] == '4'){  echo "ธ.ไทยพาณิชย์"; }  ?> 
			<br> <br> 
			IMG_PAY : <img src="../<? echo $row["IMG_PAY"] ?>" width="300px" /><br> 
			DATE_PAY :<? echo $row["DATE_PAY"] ?> <br> 
			TIME_PAY : <? echo $row["TIME_PAY"] ?> <br> 
			PRICE_PAY : <? echo $row["PRICE_PAY"] ?> <br> 
			DETAIL_PAY : <? echo $row["DETAIL_PAY"] ?> <br> 
			NAME_PAY : <? echo $row["NAME_PAY"] ?> <br> 
			EMAIL_PAY : <? echo $row["EMAIL_PAY"] ?> <br> 
			TEL_PAY : <? echo $row["TEL_PAY"] ?> <br> 
			INSERT_DATE : <? echo $row["INSERT_DATE"] ?> <br> 

<?
			}
?>



<table border="1" class="table4_3" width="100%">
		<tr>
			<th>Order</th>
			<th>ราคา</th>
			<th>วันที่</th>
			<th>สถานะ</th>
			<th>เลขพัสดุ EMS</th>
			
		</tr>
		<?
		
		$sql = "SELECT * FROM order_magic WHERE ORDER_ID = '".$_GET["order_id"]."'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) { 
		?>
		<tr>
			<td><?=$row["ORDER_ID"];?></td>
			<td><?=$row["TOTAL_SALE"];?></td>
			<td><?=$row["INSERT_DATE"];?></td>
			<? 
				if($row["STATUS"] == "0"){ 
					echo "<td>ยังไม่ได้ชำระเงิน</td>";
				}else{
					echo "<td>ชำระเงินแล้ว</td>";
				}

			?>
			<td>
			<?=$row["DISC"];?>
			</td>
			
			

					
			
			
		</tr>
		<?
		}
		
		?>
	
	
	<table>

                            </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>	
<?
	$conn->close();
	include 'footer.php';
?>