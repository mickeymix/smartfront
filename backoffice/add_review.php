<?
	include 'head.php';
?>

<?

	if($_POST["action"] == "1"){

	//	$uploadfile = $_POST["fileToUpload"];
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	mysqli_set_charset($conn,"utf8");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	


	
	$sql = "INSERT INTO review 
	       (PATH_IMG)
	VALUES ('$target_file')";

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
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
	
	
	$conn->close();
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
	
		<form  action="add_review.php" method="POST" class="form-horizontal" enctype="multipart/form-data" >
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>เพิ่มรูปReview</h2>   
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
				  
				 
					
					<label>เลือกรูป</label>
					<input type="file" name="fileToUpload" id="fileToUpload">
					<br> 
					
					
					 
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
	include 'footer.php';
?>

 
