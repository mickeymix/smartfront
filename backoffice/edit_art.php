<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>


<!-- include libs stylesheets -->
<link href="css/bootstrap4.1.3.css" rel="stylesheet"/>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="js/popper1.14.5.js"></script>


<link rel="stylesheet" href="jquery-timepicker/jquery.timepicker.min.css">
<script src="jquery-timepicker/jquery.timepicker.min.js"></script>


<!-- include summernote -->
<link rel="stylesheet" href="dist/summernote-bs4.css">
<script type="text/javascript" src="dist/summernote-bs4.js"></script>
<script src="dist/summernote-image-attributes.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<?


$id = $_GET["id_art"];

if ($id == "") {

    $id = $_POST["id_art"];
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_POST["action"] == "1") {

    $stgat = "1";
    $desp_art = $_POST["desp_art"];


    $detail_art = $_POST["detail_art"];
    $detail_art = str_replace("youtube-iframe", "www.youtube.com", $detail_art);

    $id_art = $_POST["id_art"];

    $selectoption = $_POST["selectoption"];

    $head_art = $_POST["head_art"];

    $img_art = $_POST["img_art"];

    $start_date = $_POST["start_date"];
    $start_time = $_POST["start_time"];

    if ($selectoption === "Now") {
        $start_art = date("Y-m-d h:i:sa");
    } else {
        $start_art = $start_date . " " . $start_time;
    }

    $target_dir = "img_art/";
    $uploadfile = $_FILES["fileToUpload"]["name"];
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $keyword = $_POST["keyword"];

       $paper_id = $_POST["paper_id"];

    if ($uploadfile <> '') {
        if ($_FILES['fileToUpload']['name'] == "") {
            $target_file = $img_art;
        } else {

            unlink($img_art);

            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                //	echo "File is an image - " . $check["mime"] . ".";
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
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
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
    }

    if ($uploadfile === "") {
        $sql = "UPDATE article SET 
		head_art = '$head_art' 
		, desp_art = '$desp_art' 
		, detail_art = '$detail_art' 
		, keyword = '$keyword' 
		,start_art = '$start_art'
		,paper_id = '$paper_id'
		, modify_date = SYSDATE() 
		, update_by = '$username_log'
		, post_status_date = '$selectoption'
		WHERE id_art = '$id_art'  ";
    } else {
        $sql = "UPDATE article SET 
		head_art = '$head_art' 
		, desp_art = '$desp_art' 
		, detail_art = '$detail_art' 
		, keyword = '$keyword' 
		, img_art = '$target_file' 
		,start_art = '$start_art'
		,paper_id = '$paper_id'
		, modify_date = SYSDATE() 
		, update_by = '$username_log'
		, post_status_date = '$selectoption'
		WHERE id_art = '$id_art'  ";
    }


//    if ($stat == "1") {
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "New record created successfully";
            print("><span style=\"color: red; \">แก้ไขข้อมูลสำเร็จ</span></div> ");
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
            print($alert);
        }

//    } else {
//        print("><span style=\"color: red; \">กรุณากรอกข้อมูลให้ครบค่ะ</span></div>");
//    }


}


?>


<div id="wrapper">
    <?php include("top.php"); ?>
    <!-- /. NAV TOP  -->
    <?php include("menu.php"); ?>
    <!-- /. NAV SIDE  -->

    <form id="myform" action="edit_art.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate=""
          enctype="multipart/form-data">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-8">
                            <h2>เพิ่ม Blog</h2>
                        </div>
                        <div class="col-md-4" align="right">

                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr/>
                <!-- /. ROW  -->
                <?php if ($alert <> "") { ?>
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo "$alert"; ?>
                    </div>
                <?php } ?>

                <?


                $sql = "SELECT * FROM article WHERE id_art = '$id'   ";


                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {


                    ?>

                    <br>

                    <label>Header</label>
                    <input class="form-control" placeholder="" type="text" name="head_art"
                           value="<?= $row["head_art"]; ?>"/>
                    <br>

                    <label>Description</label>

                    <input class="form-control" placeholder="" type="text" name="desp_art"
                           value="<?= $row["desp_art"]; ?>"/>

                    <br>

                    <label>Detail</label>

                    <div class="summernote2"><?= $row["detail_art"]; ?></div>

                    <textarea rows="4" cols="50" style="display:none;" name="detail_art">
					</textarea>
                    <br>


                    <img src="<?php echo $row["img_art"]; ?>" width="200px">
                    <br> <br>


                    <label>Head Imgage</label>
                    <input type="file" name="fileToUpload" id="fileToUpload"/>
                    <br>


                    <label>Keyword</label>
                    <input class="form-control" placeholder="" type="text" name="keyword"
                           value="<?php echo $row["keyword"]; ?>"/>
                    <br>
                    <label>Paper ID</label>
                    <input class="form-control" placeholder="" type="text" name="paper_id" value="<?php echo $row["paper_id"]; ?>"/>
                    <br>

                    <?

//                        echo "<script> console.log('dsdsdsdsd'+'". $row["start_art"]."')</script>";
//
//					  $date_time_art = split (" ", $row["start_art"]);
//                        echo "<script> console.log('dsdsdsdsd'+'". $date_time_art."')</script>";


                    ?>

                    <select id="selectoption" name="selectoption" class="col-6 col-md-4 browser-default custom-select">

                        <option <? if ($row["post_status_date"] === "Now")  { ?>selected<?
                        } ?> value="Now">แชร์เลย
                        </option>
                        <option
                            <? if ($row["post_status_date"] === "Assign" or $row["post_status_date"] === "") { ?>selected<?
                        } ?> value="Assign">กำหนดเวลา
                        </option>
                    </select>

                    <br><br><br>

                    <div id="datecontent">
                        <label>วันที่ :</label>


                        <div class="input-group">

                            <input type="text" name="start_date" id="datepicker"
                                   value="<? echo date("Y-m-d", strtotime($row["start_art"])); ?>"
                                   placeholder="ปี ค.ศ.-เดือน-วัน"/>
                            <label class=" btn" for="date" style="background-color: #cbcdd1;">
                                <span class="fa fa-calendar d1 open-datetimepicker"></span>
                            </label>


                        </div>
                        <br>
                        <label>เวลา :</label>
                        <input type="text" name="start_time" placeholder="23:59" id="time"
                               value="<? echo date("h:i", strtotime($row["start_art"])); ?>"/>


                    </div>

                    <br>

                    <br>
                    <input type="hidden" name="img_art" value="<?php echo $row["img_art"]; ?>"/>
                    <input type="hidden" name="id_art" value="<?php echo $row["id_art"]; ?>"/>

                    <?

                }

                ?>
                <input type="hidden" name="action" value="1"/>
                <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save</button>
                <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset
                </button>
                <a href="javascript:void(0)" onclick="backHome('ma_art.php');" class="btn btn-default">Back</a>


            </div>
            <!-- /. PAGE INNER  -->
        </div>

        <!-- /. PAGE WRAPPER  -->
</div>

</form>
<script type="text/javascript">
    $(document).ready(function () {

        $('.summernote2').summernote({
            popover: {
                image: [
                    ['custom', ['imageAttributes']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    ['remove', ['removeMedia']]
                ],
            },
            lang: 'en-US', // Change to your chosen language
            imageAttributes: {
                icon: '<i class="note-icon-pencil"/>',
                removeEmpty: true, // true = remove attributes | false = leave empty if present
                disableUpload: true // true = don't display Upload Options | Display Upload Options
            }
        });


        $('#myform').on('keyup keypress', function (e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });

    });
    $(document).ready(function () {
        $('#time').timepicker({
            interval: 30,
            timeFormat: 'HH:mm'
        });
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $("select").change(function () {
            $(this).find("option:selected").each(function () {
                var optionValue = $(this).attr("value");
                console.log("MIXMIXMIX: " + optionValue)
                if (optionValue === "Now") {
                    document.getElementById("datecontent").style.display = "none";
                } else {
                    document.getElementById("datecontent").style.display = "block";
                }
            });
        }).change();
    });
</script>

<script>
    function sumit_edit_product() {
        var summernote2 = $('.summernote2').summernote('code').trim();


        document.getElementsByName("detail_art")[0].value = summernote2.replace(/\www.youtube.com/g, "youtube-iframe");


        $("#myform").submit();

    }
</script>

<?

$conn->close();
include 'footer.php';
?>

 

 