<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");		
	
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");
?>

<?

	if($_POST["action"] == "1"){

	//	$uploadfile = $_POST["fileToUpload"];
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	
$name_button = $_POST["name_button"];
	
	$id  = $_POST["id"];

		$sql = "SELECT img FROM email_img WHERE id='".$id."'";
	
	
	$result = $conn->query($sql);
 
		while($row = $result->fetch_assoc()) {

				
				print($row["img"]);

				unlink($row["img"]);
		}	

	$sql ="DELETE FROM email_img WHERE id='".$id."'";
			
				if ($conn->query($sql) === TRUE) {
					$alert="DELETE successfully";
				} else {
					$alert="Error: " . $sql . "<br>" . $conn->error;
				}
	
	
	

	
	$sql = "INSERT INTO email_img  
	       (img,insert_date,update_by ,name_button)
	VALUES ('$target_file',SYSDATE(),'$username_log' ,'$name_button')";

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		$alert="New record created successfully";
	} else {
		$alert="Error: " . $sql . "<br>" . $conn->error;
	}



$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
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
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
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
	
		<form  action="ma_img_email.php" method="POST" class="form-horizontal" enctype="multipart/form-data" >
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>จัดการภาพพื้นหลัง Email</h2>   
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
						$sql = "SELECT id ,img ,name_button FROM email_img ORDER BY insert_date DESC limit 1";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()) {
					?>
						<input type="hidden" name="id" value="<? echo $row["id"] ?>" />
						<img src="<? echo $row["img"] ?>" />
				
					<br>
					<label>เลือกรูป</label>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<font color="red"> *Width 476 & height 400 </font>
					
					 <br/> <br/> 
					
					<label>ชื่อปุ่ม :</label>
					<input class="form-control" placeholder="" type="text" name="name_button"  value="<?=$row["name_button"];?>" />
					<br/>
					<?}?>	
					 <br/> <br/> 
					<input type="hidden" name="action" value="1" />
                     <button type="submit" class="btn btn-success">  Save  </button>
                     <button type="reset" class="btn btn-primary">Reset</button>   
					 <a href="" class="btn btn-default">Back</a>              


    </div>
             <!-- /. PAGE INNER  -->
            </div>
		
         <!-- /. PAGE WRAPPER  -->
        </div>

</form>

			<script data-sample="1">
				CKEDITOR.replace( 'editor1' );
				CKEDITOR.replace( 'editor2' );
				
			</script>
			
<?
	$conn->close();
	include 'footer.php';
?>

 
