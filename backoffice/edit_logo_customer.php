<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");		
	
$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn,"utf8");

?>

<?
$id = $_GET["id"];
if ($id == "") {

	$id = $_POST["id"];
}

	if($_POST["action"] == "1"){

        $uploadfile = $_POST["fileToUpload"];
        if($uploadfile <>''){
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        }

	
$name_button = $_POST["name_button"];
	
	$id  = $_POST["id"];

	// 	$sql = "SELECT img FROM email_img WHERE id='".$id."'";
	
	
	// $result = $conn->query($sql);
 
	// 	while($row = $result->fetch_assoc()) {

				
	// 			print($row["img"]);

	// 			unlink($row["img"]);
	// 	}	


	

    if($uploadfile <>''){
        $sql = "UPDATE customer_logo_page SET image_logo = '$target_file', linktestimo = '$name_button' WHERE id = $id";

    }else{
        $sql = "UPDATE customer_logo_page SET linktestimo  = '$name_button' WHERE id = $id";

    }

	if ($conn->query($sql) === TRUE) {
		$last_id = $conn->insert_id;
		$alert="LOGO ได้ใรการแก้ไขแล้ว";
	} else {
		$alert="Error: " . $sql . "<br>" . $conn->error;
	}


    if($uploadfile <>''){
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
	
		<form  action="edit_logo_customer.php" method="POST" class="form-horizontal" enctype="multipart/form-data" >
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>แก้ไขภาพLOGO ของ Customer</h2>   
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
                        $sql = "SELECT id ,image_logo ,linktestimo FROM customer_logo_page where id = ".$id."";
                        // console.log($_GET["id"]);
                        echo ("<script>
                        console.log(<?= '.$id.' ?>);
                    </script>");
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()) {
					?>
						<input type="hidden" name="id" value="<? echo $row["id"] ?>" />
						<img src="<? echo $row["image_logo"] ?>" />
				
					<br>
					<label>เลือกรูป</label>
                <font color="red"> *Width 259 & height 194 </font>
					<input type="file" name="fileToUpload" id="fileToUpload">
				
					
					 <br/> <br/> 
					
					<label>linkเข้าสู่บทความ</label>
					<input class="form-control" placeholder="" type="text" name="name_button"  value="<?=$row["linktestimo"];?>" />
					<br/>
					<?}?>	
					 <br/> <br/> 
					<input type="hidden" name="action" value="1" />
                     <button type="submit" class="btn btn-success">  Save  </button>
					 <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
                <a href="javascript:void(0)" onclick="backHome('ma_logo_customer.php');"  class="btn btn-default">Back</a>


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

 
