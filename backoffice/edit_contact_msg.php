<?
	include 'head.php';
	
	
	$alert = $_GET["alert"];
	
	$conn = mysqli_connect($host, $user, $pass, $dbname);

	mysqli_set_charset($conn,"utf8");
	
	
	if($_POST["action"] == "1"){
	
		$msg_fb = $_POST["msg_fb"];
		$msg_line = $_POST["msg_line"];
		$msg_phone = $_POST["msg_phone"];
		$msg_email = $_POST["msg_email"];
		$btn_msg = $_POST["btn_msg"];
		$val_facebook = $_POST["val_facebook"];
		$val_line = $_POST["val_line"];
		$val_phone = $_POST["val_phone"];
		$val_email = $_POST["val_email"];

	
	
		$sql = "UPDATE msg_contact SET 
		msg_fb = '$msg_fb' 
		,msg_line = '$msg_line' 
		,msg_phone = '$msg_phone' 
		,msg_email = '$msg_email' 
		,val_facebook = '$val_facebook' 
		,val_line = '$val_line' 
		,val_phone = '$val_phone' 
		,val_email = '$val_email' 
		WHERE id = 1 ";

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="อัพเดตข้อมูลเรียบร้อย";
			//$alert=$sql;
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
	
	}
	
	
?>


<script src="js/ckeditor.js"></script>
	<script src="js/sample.js"></script>
 <link rel="stylesheet" href="styles/bootstrap.min.css">
 <div id="wrapper">
        <?php include("top.php");?>   
           <!-- /. NAV TOP  -->
                <?php include("menu.php");?>  
        <!-- /. NAV SIDE  -->
	
		<form  action="edit_contact_msg.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="">
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Edit Contact Message</h2>   
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
				  
				  
					<?php
 
					 		 
					$sql = "SELECT * FROM msg_contact ";				
				    $query = mysqli_query($conn, $sql);
		
						while ($result = mysqli_fetch_assoc($query)) {
					?>		
				  
           
					
					<label>Facebook</label>
					<input class="form-control" placeholder="" type="text" name="msg_fb" value="<?php echo $result['msg_fb']; ?>" />
					<br> 
					<input class="form-control" placeholder="กรุณาใส่ link facebook" type="text" name="val_facebook" value="<?php echo $result['val_facebook']; ?>" />
					<br> 
					
					<label>Line</label>
					<input class="form-control" placeholder="" type="text" name="msg_line" value="<?php echo $result['msg_line']; ?>" />
					<br> 
					<input class="form-control" placeholder="กรุณาใส่ link Line@" type="text" name="val_line" value="<?php echo $result['val_line']; ?>" />
					<br> 
					
					<label>Tel.</label>
					<input class="form-control" placeholder="" type="text" name="msg_phone" value="<?php echo $result['msg_phone']; ?>" />
					<br> 
					<input class="form-control" placeholder="กรุณาใส่เบอร์โทรศัพท์" type="text" name="val_phone" value="<?php echo $result['val_phone']; ?>" />
					<br> 
					
					<label>Email</label>
					<input class="form-control" placeholder="" type="text" name="msg_email" value="<?php echo $result['msg_email']; ?>" />
					<br> 
					<input class="form-control" placeholder="กรุณาใส่ email ติดต่อ" type="text" name="val_email" value="<?php echo $result['val_email']; ?>" />
					<br> 
					
					<label>Button</label>
					<input class="form-control" placeholder="" type="text" name="btn_msg" value="<?php echo $result['btn_msg']; ?>" />
					<br>
					
					<? 
						
						}
						
					?> 	
				
					<br> <br><br>
					
					 
					<input type="hidden" name="action" value="1" />
					<input type="hidden" name="product_promo_type" value="recommen" />
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              


    </div>
             <!-- /. PAGE INNER  -->
            </div>
		
         <!-- /. PAGE WRAPPER  -->
        </div>

	</form>

			
			
<?
	$conn->close();
	include 'footer.php';
?>

 
