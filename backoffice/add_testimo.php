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


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_POST["action"] == "1") {

    $stat = "1";

    $head_testimo = $_POST["head_testimo"];

    $desp_testimo = $_POST["desp_testimo"];

    $selectoption = $_POST["selectoption"];
    $short_description_testimo = $_POST["short_description"];

    $desp_testimo = str_replace("youtube-iframe", "www.youtube.com", $desp_testimo);

    $target_dir = "img_testimo/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $keyword = $_POST["keyword"];

    $start_date = $_POST["start_date"];
    $start_time = $_POST["start_time"];
    $start_testimo = $start_date . " " . $start_time;
    if ($selectoption === "Now"){
        $start_art = date("Y-m-d h:i:sa");
    }else{
        $start_art = $start_date . " " . $start_time;
    }



    $sql = "INSERT INTO testimo (head_testimo, desp_testimo, img_testimo ,keyword,start_art,insert_date,update_by,post_status_date,short_description_testimo) 
		VALUES ('$head_testimo', '$desp_testimo', '$target_file','$keyword','$start_testimo',SYSDATE(),'$username_log','$selectoption','$short_description_testimo' ) ";


    if ($stat == "1") {
        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "New record created successfully";
            print(" <center><font color='red'>เพิ่มข้อมูลสำเร็จ</font></center> ");
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
            print($alert);
        }
    } else {
        print(" <center><font color='red'>กรุณากรอกข้อมูลให้ครบค่ะ</font></center>");
    }

    $conn->close();

    if ($_FILES['fileToUpload']['name'] == "") {
        $alert = "ไม่พบไฟล์รูป";
    } else {
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
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                //	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}


?>


    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->

        <form id="myform" action="add_testimo.php" method="POST" class="form-horizontal" data-parsley-validate=""
             enctype="multipart/form-data">
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <h2>เพิ่ม Testimonial</h2>
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
                    <label>Header</label>
                    <input class="form-control" placeholder="" type="text" name="head_testimo" value="" required/>
                    <br>

                    <label>Short Description</label>
                    <input class="form-control" placeholder="" type="text" name="short_description" value=""/>

                    <label>Description</label>

                    <div class="summernote1"></div>

                    <textarea rows="4" cols="50" style="display:none;" name="desp_testimo">
					</textarea>
                    <br>

                    <label>Head Imgage</label>
                    <input type="file" name="fileToUpload" id="fileToUpload"/>
                    <br>

                    <label>Keyword</label>
                    <input class="form-control" placeholder="" type="text" name="keyword" value=""/>
                    <br>

                    <select id="selectoption" name="selectoption" class="col-6 col-md-4 browser-default custom-select">

                        <option selected value="Now">แชร์เลย</option>
                        <option value="Assign">กำหนดเวลา</option>
                    </select>
                    <br><br>


                    <div id="datecontent">
                        <label>วันที่ :</label>

                        <div class="input-group">

                            <input type="text" name="start_date" id="datepicker" placeholder="ปี ค.ศ.-เดือน-วัน"
                                   value="<?
                                   date_default_timezone_set('Asia/Bangkok');
                                   echo date("Y-m-d") ?>"/>
                            <label class=" btn" for="date" style="background-color: #cbcdd1;">
                                <span class="fa fa-calendar d1 open-datetimepicker"></span>
                            </label>


                        </div>
                        <br>
                        <label>เวลา :</label>
                        <br>
                        <!-- echo("<script>console.log('start_testimo: isNullorblank ". date("h:i:sa") ."');</script>"); -->
                        <input type="text" name="start_time" placeholder="23:59" id="time" value="<?
                        date_default_timezone_set('Asia/Bangkok');
                        echo date("h:i") ?>"/>


                    </div>

                    <br/>
                    <br/>

                    <input type="hidden" name="action" value="1"/>


                    <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save</button>
                    <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">
                        Reset
                    </button>
                    <a href="javascript:void(0)" onclick="backHome('ma_testimo.php');" class="btn btn-default">Back</a>


                </div>
                <!-- /. PAGE INNER  -->
            </div>

            <!-- /. PAGE WRAPPER  -->
    </div>

    </form>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.summernote1').summernote({
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

    <script>
        function sumit_edit_product() {
            var summernote1 = $('.summernote1').summernote('code').trim();


            document.getElementsByName("desp_testimo")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");


            $("#myform").submit();


        }
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

<?

include 'footer.php';

?>

<?
function IsNullOrEmptyString($str)
{
    return (!isset($str) || trim($str) === '');
}

?>