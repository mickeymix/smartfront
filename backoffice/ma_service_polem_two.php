<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

if ($_POST["action"] == "1") {

	$target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadFile = $_FILES["fileToUpload"]["name"];



	// $name_button = $_POST["name_button"];


	$service_title_two = $_POST["service_title_two"];
	 $service_link_two = $_POST["service_link_two"];


    if ($uploadFile<>''){
        $sql = "UPDATE service_config SET 
	service_title_two = '$service_title_two' 
	,service_link_two = '$service_link_two'
	,service_img_two = '$target_file'
	WHERE id = 1 ";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "อัพเดตข้อมูลเรียบร้อย";
            //$alert=$sql;
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
        }

    }else{
        $sql = "UPDATE service_config SET 
	service_title_two = '$service_title_two' 
	,service_link_two = '$service_link_two'
	WHERE id = 1 ";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "อัพเดตข้อมูลเรียบร้อย";
            //$alert=$sql;
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
        }


        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
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
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            // @move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
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
	<?php include("top.php"); ?>
	<!-- /. NAV TOP  -->
	<?php include("menu.php"); ?>
	<!-- /. NAV SIDE  -->

	<form action="ma_service_polem_two.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<h2>เมนูจัดการ service</h2>
					</div>
				</div>
				<!-- /. ROW  -->
				<hr />
				<!-- /. ROW  -->
				<?php if ($alert <> "") { ?>
					<div class="alert alert-info alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo "$alert"; ?>
					</div>
				<?php } ?>


				<?
				//$sql = "SELECT service_top_title  FROM service_config WHERE id ='1";


				//	$result = $conn->query($sql);

				$sql = "SELECT * FROM service_config ";
				$query = mysqli_query($conn, $sql);

				while ($result = mysqli_fetch_assoc($query)) {
					?>
					<br />
					<img src="<? echo $result["service_img_two"] ?>" />

					<br>
					<label>เลือกรูป คำนิยาม2</label>
					
					<br/>
					<font color="red"> ** กรุณา Upload ไฟล์รูปเป็นชื่อภาษาอังกฤษเท่านั้น ** </font> 
					<br/> 
					<input type="file" name="fileToUpload" id="fileToUpload"/>
					<font color="red"> *Width 300 & height 300 </font>

					<br /> <br />

					<label>คำนิยาม1 :</label>
					<input class="form-control" placeholder="" type="text" name="service_title_two" value="<?= $result["service_title_two"]; ?>" />
					<br />
                    <label>Link :</label>
                    <input class="form-control" placeholder="" type="text" name="service_link_two" value="<?= $result["service_link_two"]; ?>" />
                    <br />
				<?
			}
			?>
				<br /> <br />
				<input type="hidden" name="action" value="1" />
				<button type="submit" class="btn btn-success"> Save </button>
				<button type="reset" class="btn btn-primary">Reset</button>
				<a href="" class="btn btn-default">Back</a>


			</div>
			<!-- /. PAGE INNER  -->
		</div>

		<!-- /. PAGE WRAPPER  -->
</div>

</form>

<script data-sample="1">
	CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
</script>

<?
$conn->close();
include 'footer.php';
?>