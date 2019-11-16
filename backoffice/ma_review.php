<?
	include 'head.php';
	
	// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_set_charset($conn,"utf8");
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
?>


<?
	$id  = $_GET["id"];
	if($_GET["action"] == "998"){
		$sql = "SELECT PATH_IMG FROM review WHERE ID='".$id."'";
	
	
	$result = $conn->query($sql);
 
		while($row = $result->fetch_assoc()) {

				
				print($row["PATH_IMG"]);

				unlink($row["PATH_IMG"]);
		}	

	$sql ="DELETE FROM review WHERE ID='".$id."'";
			
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
                                            <th>รูป</th>
											<th>ลบ</th>
                                       
											<th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
<? 

		
	
	
		
		$sql = "SELECT * FROM review ORDER BY INSERT_DATE DESC";
		
		
		$result = $conn->query($sql);
	   	$i =0;
			while($row = $result->fetch_assoc()) {
			$i++;
?>									
                                        <tr>
                                            <td><? echo $i?></td>
                                            <td><img src="<? echo $row["PATH_IMG"] ?>" width="50px" ></td>
										
											<td>
											
											<button class="btn btn-danger" onClick="javascript:location.href='ma_review.php?action=998&id=<? echo $row["ID"] ?>'"><i class="fa fa-pencil"></i>ลบ</button>
											</td>
											<td></td>
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