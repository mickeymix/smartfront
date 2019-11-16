<?
	include 'head.php';
	
	if($_POST["action"] == "1"){
		$conn = new mysqli($host, $user, $pass, $dbname);
		mysqli_set_charset($conn,"utf8");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		
	
		$name_sub_menu = $_POST["name_sub_menu"];
		$desc_sub_menu = $_POST["desc_sub_menu"];
		$id_menu = $_POST["id_menu"];
		$url_menu = $_POST["url_menu"];		
		$target_dir = "img_menu/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
		
			$sql = "INSERT INTO sub_menu (name_sub_menu, desc_sub_menu ,id_menu,url_menu,sub_menu_img ,modify_date,insert_date,update_by)
			VALUES ('$name_sub_menu','$desc_sub_menu','$id_menu','$url_menu','$target_file',SYSDATE(),SYSDATE(),'$username_log')";

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New product successfully.";
			} else {
				$alert="Error: " . $sql . "<br>" . $conn->error;
			}
		$conn->close();	
		

		
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image

		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
		//	echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
		//	echo "File is not an image.";
			$uploadOk = 0;
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			//	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
	$conn = new mysqli($host, $user, $pass, $dbname);
	mysqli_set_charset($conn,"utf8");
	$id  = $_GET["id"];
	if($_GET["action"] == "998"){
	
		$sql = "SELECT sub_menu_img FROM sub_menu WHERE id_sub_menu='".$id."'";
	
	
		$result = $conn->query($sql);
 
		while($row = $result->fetch_assoc()) {

				
				print($row["sub_menu_img"]);

				unlink($row["sub_menu_img"]);
		}	
	
	$sql ="DELETE FROM sub_menu WHERE id_sub_menu ='".$id."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
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
	
		
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>เพิ่มSub Menu</h2>   
                    </div>
                </div>      
				 <div class="row">
                    <div class="col-md-12">
						  <div class="table-responsive">
		
								  <h4>Menu Main</h4>
		
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            
											
											<th>Menu Name</th>
                                            <th>Keyword</th>
											<th>imgages</th>				
                                           
											
                                        </tr>
                                    </thead>
                                    <tbody>
									
																		
										<?
											
											
											$id_menu = $_GET["id_menu"];
											
											 
 
											 if($id_menu == null){
													$id_menu = $_POST["id_menu"];
											 }
										
											 $sql = "SELECT * FROM menu  WHERE id_menu=$id_menu  ";					
											 $query = mysqli_query($conn, $sql);	
												
										
											while ($result = mysqli_fetch_assoc($query)) {
										
										?>								
																				<tr>
																					
																				
																					<td><?php echo $result['menu_name']; ?>	</td>
																					<td><?php echo $result['menu_keyword']; ?>	</td>
																					<td><img src="<?php echo $result['menu_img']; ?>" width="32px" /></td>
																					
																	
																				
																					
																				</tr>
										<? 
											}
											
										?>     
																		 
																			</tbody>
																		</table>
					</div>
					  <h4>SubMenu Main</h4>
					   <div class="table-responsive">
		

		
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
											
											
											<th>SubMenu Name</th>
                                            <th >URL</th>
											<th>Description</th>
											<th>imgages</th>	
											<th style="text-align:center; " >แก้ไข</th>											
                                            <th style="text-align:center; " >ลบ</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									
				 <?php
				 
				 $perpage = 100;
					 if (isset($_GET['page'])) {
						$page = $_GET['page'];
					 } else {
						$page = 1;
					 }
				 
				 $start = ($page - 1) * $perpage;
				 
						$sql = "SELECT * FROM sub_menu WHERE id_menu = '$id_menu'  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
						
						
				 $query = mysqli_query($conn, $sql);
				 ?>									
				<? 

					 $i =0;
					while ($result = mysqli_fetch_assoc($query)) {
					$i++;
				?>								
														<tr>
															<td><? echo $i?></td>
															
															<td><?php echo $result['name_sub_menu']; ?>	</td>
															<td  ><?php echo substr($result['url_menu'],0,30); ?>.....	</td>
															<td><?php echo $result['desc_sub_menu']; ?>	</td>
															<td><img src="<?php echo $result['sub_menu_img']; ?>" width="32px" /></td>
															
																<td style="text-align:center; width:20;">
																<button class="btn btn-primary" onClick="javascript:location.href='edit_submenu.php?id_sub_menu=<?php echo $result['id_sub_menu']; ?>&id_menu=<? echo $id_menu; ?>'"><i class="fa fa-edit "></i>แก้ไข</button>
															</td>
															<td style="text-align:center; width:20;">
															
															<button class="btn btn-danger" 
															onClick="javascript:location.href='add_submenu.php?action=998&id=<?php echo $result['id_sub_menu']; ?>&id_menu=<? echo $id_menu; ?>'">
															<i class="fa fa-pencil"></i>ลบ</button>
															</td>
															
														</tr>
				<? 
					}
					
				?>     
												 
													</tbody>
												</table>
												
				<?php

					if($i == 0){
						
							echo "not found.";
					}	

				
					 
				 $sql2 = "SELECT * FROM sub_menu ";
				 $query2 = mysqli_query($conn, $sql2);
				 $total_record = mysqli_num_rows($query2);
				 $total_page = ceil($total_record / $perpage);
				 ?>
				 <nav>
					 <ul class="pagination">
						 <li>
							 <a href="add_submenu.php?page=1" aria-label="Previous">
								 <span aria-hidden="true">&laquo;</span>
							 </a>
								 </li >
									 <?php for($i=1;$i<=$total_page;$i++){ ?>
									 
									 <?
									 if($i == $page){
									?>	 
										<li class='active'><a  href="add_submenu.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
									<?	
									}else{
									?>
										<li><a href="add_submenu.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
									<?	
									}
									 ?>
										
									 <?php } ?>
								 <li>
							 <a href="add_submenu.php?page=<?php echo $total_page;?>" aria-label="Next">
								 <span aria-hidden="true">&raquo;</span>
							 </a>
						 </li>
					 </ul>
				 </nav> 

			
				 	
				
                 <!-- /. ROW  -->
                  <hr />
                  <!-- /. ROW  -->
				  <?php if($alert<>""){ ?>
				  <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <?php echo "$alert"; ?>    
                   </div>
					 <?php } ?>		
				  
				  <form  action="add_submenu.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="" enctype="multipart/form-data" >
					<label>SubMenu Name</label>
					<input class="form-control" placeholder="" type="text" name="name_sub_menu" value="" />
					<br> 
					
					<label>URL</label>
					<input class="form-control" placeholder="" type="text" name="url_menu" value="" />
					<br> 
					
					<label>Description</label>
					<input class="form-control" placeholder="" type="text" name="desc_sub_menu" value="" />
					<br> 
					
					<label>Imgage</label>
					<input type="file" name="fileToUpload" id="fileToUpload" />
					<br> 
					
				
					<br> <br><br>
					
					 
					<input type="hidden" name="id_menu" value="<? echo $id_menu; ?>" />
					<input type="hidden" name="action" value="1" />
		
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              

				</form>
				</div>
			</div>
             <!-- /. PAGE INNER  -->
            </div>
		
         <!-- /. PAGE WRAPPER  -->
        </div>

	

<?
	$conn->close();
?>			
			
<?
	include 'footer.php';
?>

 
