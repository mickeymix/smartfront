<?
	include 'head.php';
		$conn = new mysqli($host, $user, $pass, $dbname);
		mysqli_set_charset($conn,"utf8");

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
	if($_POST["action"] == "1"){
		
		$id_menu = $_POST["id_menu"];
		$menu_keyword = $_POST["menu_keyword"];
		$menu_img = $_POST["menu_img"];
		$menu_name = $_POST["menu_name"];
		
		
		$target_dir = "img_menu/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
			//$sql = "INSERT INTO menu (menu_keyword, menu_img,menu_name,modify_date,insert_date)
			//VALUES ('$menu_keyword','$target_file','$menu_name',SYSDATE(),SYSDATE())";
			if($_FILES['fileToUpload']['name'] == "") 
			{
				$target_file = $menu_img;
			}else{
				//print($menu_img);

				unlink($menu_img);
				
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image

				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
			//		echo "File is an image - " . $check["mime"] . ".";
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
				
			
			$sql = "UPDATE menu SET menu_name = '$menu_name' , menu_keyword = '$menu_keyword' , menu_img = '$target_file' , modify_date = SYSDATE() , update_by = '$username_log' WHERE id_menu = '$id_menu'  ";

			if ($conn->query($sql) === TRUE) {
				$last_id = $conn->insert_id;
				$alert="New product successfully.";
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
	
		<form  action="edit_menu.php" method="post" class="form-horizontal" data-parsley-validate="" novalidate="" enctype="multipart/form-data" >
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>เพิ่มเมนู</h2>   
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
					
				  <?
				
					$id_menu = isset($_GET['id_menu']) ? $_GET['id_menu'] : $_POST["id_menu"];
				
				  
					$sql = "SELECT * FROM menu  WHERE id_menu = '$id_menu'";
					$query = mysqli_query($conn, $sql);
					while ($result = mysqli_fetch_assoc($query)) {
				  ?>
				  
					<label>Menu Name</label>
					<input class="form-control" placeholder="" type="text" name="menu_name" value="<?php echo $result['menu_name']; ?>" />
					<br> 
					
					<label>Menu Keyword</label>
					<input class="form-control" placeholder="" type="text" name="menu_keyword" value="<?php echo $result['menu_keyword']; ?>" />
					<br> 
					
					<img src="<?php echo $result['menu_img']; ?>" />
					<br> <br> 
					<label>Menu Imgage</label>
					<input type="file" name="fileToUpload" id="fileToUpload" />
					<br> 
					
				
					<br> <br><br>
					 <input type="hidden" name="menu_img" value="<?php echo $result['menu_img']; ?>" />
					 <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" />
					<input type="hidden" name="action" value="1" />
		
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              			
				<? 
					}
				?>	

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

 
