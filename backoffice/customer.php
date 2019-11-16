<?
	include 'head.php';
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
                     <h2>ข้อมูลลูกค้า</h2>   
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
                                            <th>ชื่อลูกค้า</th>
                                            <th>อีเมล</th>
											<th>พาสเวิร์ด</th>
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<? 
// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "SELECT * FROM member_magic ORDER BY  INSERT_DATE DESC ";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>									
                                        <tr>
                                            <td><? echo $i?></td>
                                            <td><? echo $row["NAME"] ?></td>
											<td>
											<? echo $row["EMAIL"] ?>
											</td>
											<td><? echo $row["PASSWORD"] ?></td>
											<td><a href="customerDetail.php?cus_id=<?=$row["ID"];?>" ><img src="../images/edit.jpg" width="20px" ></a></td>
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
<?
	include 'footer.php';
?>