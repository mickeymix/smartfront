<?
	include 'head.php';
	
	// Create connection
		
		mysqli_set_charset($conn,"utf8");
?>


<?
	$id  = $_GET["id"];
	if($_GET["action"] == "998"){
		$sql = "SELECT image FROM product_image WHERE product_code='".$id."'";
	
	
	$result = $conn->query($sql);
 
		while($row = $result->fetch_assoc()) {

				
				print($row["image"]);

				unlink($row["image"]);
		}	

	$sql ="DELETE FROM product_image WHERE product_code='".$id."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
				} else {
					$alert="Error: " . $sql . "<br>" . $conn->error;
				}
	
	$sql ="DELETE FROM product_main WHERE product_code='".$id."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
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
                     <h2>ข้อมูลสินค้า</h2>   
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
                                            <th>รหัสสินค้า</th>
											<th>ชื่อสินค้า</th>				
                                            <th>แก้ไข</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
<? 

		
	
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
		$sql = "SELECT * FROM product_main ORDER BY INSERT_DATE DESC";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>									
                                        <tr>
                                            <td><? echo $i?></td>
                                            <td><? echo $row["product_code"] ?></td>
											<td ><? echo $row["product_title_th"] ?></td>
										
							
											<td style="text-align:center;">
											<button class="btn btn-primary" onClick="javascript:location.href='edit_product.php?id=<? echo $row["product_code"] ?>'"><i class="fa fa-edit "></i>แก้ไข</button>
											<button class="btn btn-danger" onClick="javascript:location.href='ma_product.php?action=998&id=<? echo $row["product_code"] ?>'"><i class="fa fa-pencil"></i>ลบ</button>
											</td>
											
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