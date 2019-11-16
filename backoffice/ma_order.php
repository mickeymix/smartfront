<? include 'head.php';
	
	
	if($_GET["action"] == "2"){
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
		$orderid = $_GET["orderid"];
		$sql ="DELETE FROM order_magic WHERE ORDER_ID='".$orderid."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
				} else {
					$alert="Error: " . $sql . "<br>" . $conn->error;
				}
				
		$conn->close();		
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
                     <h2>ข้อมูล order</h2>   
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
										<th>Customer</th>
                                          <th>Order</th>
			<th>ราคา</th>
			<th>วันที่</th>
			<th>สถานะ</th>
			<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?
	
		mysqli_set_charset($conn,"utf8");
		
	

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "SELECT * FROM order_magic ORDER BY INSERT_DATE DESC";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) { 
		?>
		<tr>
			<td><?=$row["USER_NAME"];?></td>
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
			<td><a href="order_detail.php?order_id=<?=$row["ORDER_ID"];?>" ><img src="../images/edit.jpg" width="20px" ></a></td>
			<td><input type="button" value="ยกเลิก"   onclick="aaa('<?=$row['ORDER_ID'];?>');" ></td>
		</tr>
		<?
		}
		$conn->close();
		?>                               
                                    </tbody>
                                </table>
                            </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>			
	<script>
		function aaa(orderID){
			window.location.href = 'ma_order.php?action=2&orderid=' +orderID  ;
		}
	</script>
<?
	include 'footer.php';
?>