<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

?>

<?

if ($_POST["action"] == "1") {

    $uploadfile = $_FILES["email_image_title"]["name"];
    if ($uploadfile <> '') {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["email_image_title"]["name"]);
    }

    $uploadfileemail_button_image = $_FILES["email_button_image"]["name"];
    if ($uploadfileemail_button_image <> '') {
        $target_dir = "images/";
        $target_fileButton = $target_dir . basename($_FILES["email_button_image"]["name"]);
    }

    $uploadfileemail_image_left = $_FILES["email_image_left"]["name"];
    if ($uploadfileemail_image_left <> '') {
        $target_dir = "images/";
        $target_imageleft = $target_dir . basename($_FILES["email_image_left"]["name"]);
    }

    $uploadfileemail_image_right = $_FILES["email_image_right"]["name"];
    if ($uploadfileemail_image_right <> '') {
        $target_dir = "images/";
        $target_imageright = $target_dir . basename($_FILES["email_image_right"]["name"]);
    }

    $email_email_place = $_POST["email_email_place"];

    $email_name_place_holder = $_POST["email_name_place_holder"];


    $id  = $_POST["coverid"];


    if ($uploadfile <> '' && $uploadfileemail_button_image <> '' && $uploadfileemail_image_left <> '' && $uploadfileemail_image_right <> '') {
        $sql = "UPDATE email_menu_config_master SET email_image_title = '$target_file'
        , email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder'
        , email_button_image = '$target_fileButton'
        , email_image_left = '$target_imageleft'
        , email_image_right = '$target_imageright' WHERE email_menu_id = '1'";
    } else 
    if ($uploadfile <> '') {
        $sql = "UPDATE email_menu_config_master SET email_image_title = '$target_file'
        , email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder'
        WHERE email_menu_id = '1'";
    } else if ($uploadfileemail_button_image <> '') {
        $sql = "UPDATE email_menu_config_master SET
         email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder'
        , email_button_image = '$target_fileButton'  WHERE email_menu_id = '1'";
    } else if ($uploadfileemail_image_left <> '') {
        $sql = "UPDATE email_menu_config_master SET 
         email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder'
        , email_image_left = '$target_imageleft' WHERE email_menu_id = '1'";
    }
    else if ($uploadfileemail_image_right <> '') {
        $sql = "UPDATE email_menu_config_master SET 
         email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder'
        , email_image_right = '$target_imageright' WHERE email_menu_id = '1'";
    } else {
        $sql = "UPDATE email_menu_config_master SET 
         email_email_place = '$email_email_place'
        , email_name_place_holder = '$email_name_place_holder' WHERE email_menu_id = '1'";
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

        $check = getimagesize($_FILES["email_image_title"]["tmp_name"]);
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
            if (move_uploaded_file($_FILES["email_image_title"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["email_image_title"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($uploadfileemail_button_image <> '') {
        $uploadOk = 1;
        $imageFileType = pathinfo($target_fileButton, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["email_button_image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_fileButton)) {
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
            if (move_uploaded_file($_FILES["email_button_image"]["tmp_name"], $target_fileButton)) {
                echo "The file " . basename($_FILES["email_button_image"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($uploadfileemail_image_left <> '') {
        $uploadOk = 1;
        $imageFileType = pathinfo($target_imageleft, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["email_image_left"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_imageleft)) {
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
            if (move_uploaded_file($_FILES["email_image_left"]["tmp_name"], $target_imageleft)) {
                echo "The file " . basename($_FILES["email_image_left"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    if ($uploadfileemail_image_right <> '') {
        $uploadOk = 1;
        $imageFileType = pathinfo($target_imageright, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image

        $check = getimagesize($_FILES["email_image_right"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_imageright)) {
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
            if (move_uploaded_file($_FILES["email_image_right"]["tmp_name"], $target_imageright)) {
                echo "The file " . basename($_FILES["email_image_right"]["name"]) . " has been uploaded.";
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

    <form action="edit_menu_email.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>ตั้งค่า Dialog แคตตาล๊อค</h2>
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
                $sql = "SELECT * FROM email_menu_config_master where email_menu_id = '1'";
                // console.log($_GET["id"]);

                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <input type="hidden" name="id" value="<? echo $row["email_menu_id"] ?>" />
                    <img src="<? echo $row["email_image_title"] ?>" width="50%" />
                    <br>

                    <br>
                    <label>เลือกรูปหัวเรื่อง</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_image_title" id="email_image_title">


                    <br /> <br />

                    <img src="<? echo $row["email_button_image"] ?>" width="50%" />

                    <br>
                    <label>เลือกรูปปุ่ม</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_button_image" id="email_button_image">


                    <br /> <br />

                    <img src="<? echo $row["email_image_left"] ?>" width="50%" />

                    <br>
                    <label>เลือกรูปด้านซ้าย</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_image_left" id="email_image_left">


                    <br /> <br />

                    <img src="<? echo $row["email_image_right"] ?>"width="50%"  />

                    <br>
                    <label>เลือกรูปด้านขวา</label>
                    <font color="red"> รูปควรจะมีขนาดเท่ากัน </font>
                    <input type="file" name="email_image_right" id="email_image_right">


                    <br /> <br />
                    <label>ช่องกรอก ชื่อ</label>
                    <input class="form-control" placeholder="" type="text" name="email_name_place_holder" value="<?= $row["email_name_place_holder"]; ?>" />
                    <br />

                    <label>ช่องกรอก อีเมล</label>
                    <input class="form-control" placeholder="" type="text" name="email_email_place" value="<?= $row["email_email_place"]; ?>" />
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