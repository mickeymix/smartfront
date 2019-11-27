<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>

    <!-- include libs stylesheets -->
    <link href="css/bootstrap4.1.3.css" rel="stylesheet"/>
    <script src="js/popper1.14.5.js"></script>

    <!-- include summernote -->
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script type="text/javascript" src="dist/summernote-bs4.js"></script>
    <script src="dist/summernote-image-attributes.js"></script>

<?
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}

$idPaper = $_GET['paper_id'];


if ($_POST["action"] == "1") {

    $stat = "1";
    $paper_email_template = $_POST["paper_email_template"];
    $paper_email_template = str_replace("youtube-iframe", "www.youtube.com", $paper_email_template);


    $paper_name = $_POST["paper_name"];
//    $email_altMessage = $_POST["email_altMessage"];

    if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/white_paper/".$_FILES["filUpload"]["name"])) {
        $sql = "INSERT INTO white_paper_master (paper_name,paper_email_template,paper_link,update_datetime,update_user) 
 VALUES ('".$paper_name."', '".$paper_email_template."','".$_FILES["filUpload"]["name"]."',SYSDATE(),'".$_SESSION["username_log"]."')";

        if ($stat === "1") {
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                $alert = "Upload เอกสารเรียบร้อย";
                print("><span style=\"color: red; \">แก้ไขข้อมูลสำเร็จ</span></div> ");
            } else {
                $alert = "Error: " . $sql . "<br>" . $conn->error;
                print($alert);
            }
        } else {
            print("><span style=\"color: red; \">กรุณากรอกข้อมูลให้ครบค่ะ</span></div>");
        }

    }else{
        print("><span style=\"color: red; \">ไม่สามารถอัพโหลดเอกสารได้</span></div>");
    }



}

?>

    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->

        <form id="myform" action="add_paper_smart.php" method="POST" class="form-horizontal"
              data-parsley-validate="" novalidate="" enctype="multipart/form-data">
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <h2>Add White Paper</h2>
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


                    <label>Title Paper</label>
                    <input class="form-control" placeholder="" type="text" name="paper_name" value=""/>
                    <br>


                    <label>EmailMessage</label>

                    <div class="summernote1"></div>

                    <textarea rows="4" cols="50" style="display:none;" name="paper_email_template"></textarea>
                    <br>

                    <label>File PDF</label>
                    <input type="file" name="filUpload" />
                    <br>


                    <input type="hidden" name="action" value="1"/>
                    <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save</button>
                    <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">
                        Reset
                    </button>
                    <a href="javascript:void(0)" onclick="backHome('ma_white_paper.php');" class="btn btn-default">Back</a>


                </div>
                <!-- /. PAGE INNER  -->
            </div>
        </form>

    </div>


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
    </script>

    <script>
        function sumit_edit_product() {
            var summernote1 = $('.summernote1').summernote('code').trim();

            document.getElementsByName("paper_email_template")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");

            $("#myform").submit();
        }
    </script>

<?

include 'footer.php';
?>