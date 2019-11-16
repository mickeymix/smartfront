<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

?>

<?

if ($_POST["action"] == "1") {

    $uploadfile = $_FILES["email_success_dialog_image"]["name"];
    if ($uploadfile <> '') {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["email_success_dialog_image"]["name"]);
    }

    $uploadfileemail_image_title = $_FILES["email_image_title"]["name"];
    if ($uploadfileemail_image_title <> '') {
        $target_dir = "images/";
        $target_fileTitle = $target_dir . basename($_FILES["email_image_title"]["name"]);
    }

    $email_success_link = $_POST["email_success_link"];

    if($uploadfile <>'' && $uploadfileemail_image_title<>''){
        $sql = "UPDATE email_menu_config_master SET 
        email_success_dialog_image = '$target_file'
        ,email_image_title = '$target_fileTitle
        ,email_success_link = '$email_success_link' WHERE email_menu_id = '3'";
   
    }else if ($uploadfile <>''){
        $sql = "UPDATE email_menu_config_master SET 
        email_success_dialog_image = '$target_file' WHERE email_menu_id = '3'";
    }else if ($uploadfileemail_image_title <>''){
        $sql = "UPDATE email_menu_config_master SET 
        email_image_title = '$target_fileTitle' WHERE email_menu_id = '3'";
    }else{
        $sql = "UPDATE email_menu_config_master SET email_success_link = '$email_success_link' WHERE email_menu_id = '3'";
    }

       

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $alert = "Menu Email ได้ทำการแก้ไขเรียบร้อยแล้ว";
    } else {
        $alert = "Error: " . $sql . "<br>" . $conn->error;
    }


    if ($uploadfile <> '') {
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["email_success_dialog_image"]["tmp_name"]);
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
            if (move_uploaded_file($_FILES["email_success_dialog_image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["email_success_dialog_image"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    if ($uploadfileemail_image_title <> '') {
        $uploadOk = 1;
        $imageFileType = pathinfo($target_fileTitle, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["email_image_title"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_fileTitle)) {
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
            if (move_uploaded_file($_FILES["email_image_title"]["tmp_name"], $target_fileTitle)) {
                echo "The file " . basename($_FILES["email_image_title"]["name"]) . " has been uploaded.";
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

    <form action="edit_success_page.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>แก้ไข Success Email</h2>
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
                $sql = "SELECT * FROM email_menu_config_master where email_menu_id = '3'";
                // console.log($_GET["id"]);
                echo ("<script>
                        console.log(<?= '.$sql.' ?>);
                    </script>");
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <input type="hidden" name="id" value="<? echo $row["email_menu_id"] ?>" />
                    <img src="<? echo $row["email_success_dialog_image"] ?>" width="50%" />
                    <br>

                    <br>
                    <label>เลือกรูปหน้า success</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_success_dialog_image" id="email_success_dialog_image">


                    <br /> <br />

                    <input type="hidden" name="id" value="<? echo $row["email_menu_id"] ?>" />
                    <img src="<? echo $row["email_image_title"] ?>" width="50%" />
               
                    <br>
                    <label>เลือกรูป Title หน้า Success</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_image_title" id="email_image_title">


                    <br /> <br />

                    <label>ช่องกรอก ชื่อ</label>
                    <input class="form-control" placeholder="" type="text" name="email_success_link" value="<?= $row["email_success_link"]; ?>" />
                    <br />
                <? } ?>
                <br /> <br />
                <input type="hidden" name="action" value="1" />
                <button type="submit" class="btn btn-success"> Save </button>
                <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
                <a href="javascript:void(0)" onclick="backHome('ma_product.php');" class="btn btn-default">Back</a>


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