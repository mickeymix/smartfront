<?
include 'head.php';

require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

?>

<?


if ($_POST["action"] == "1") {

    $digits = 3;
    $ranId = str_pad(rand(0, pow(10, $digits) - 1), $digits, '0', STR_PAD_LEFT);
    $startId = "SPE" . $ranId . "";


    $product_code = $startId;


    $last_id = "";

    $uploadfile = $_FILES["fileToUpload"]["name"];
    $cat_product = $_POST["product_category_code"];
    $product_category_title_th = $_POST["product_category_title_th"];
    $product_category_title_en = $_POST["product_category_title_en"];

    $product_title_en = $_POST["product_title_en"];
    $product_title_th = $_POST["product_title_th"];
    $stat = "1";
    $detail_prod_th = $_POST["detail_prod_th"];
    $detail_prod_th = str_replace("youtube-iframe", "www.youtube.com", $detail_prod_th);

    // $product_unit_en = $_POST["product_unit_en"];
    // $product_unit_th = $_POST["product_unit_th"];
    // $warranty_days = $_POST["warranty_days"];


    // Create connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // $product_code,
    // $product_title_en,
    // $product_title_th,
    // $product_unit_en,
    // $product_unit_th,
    // $warranty_days,
    // $product_type_code,
    // $product_type_title_th,
    // $product_type_title_en,
    // $product_category_code,
    // $product_category_title_th,
    // $product_category_title_en,
    // $conn

    echo("<script>console.log('product_code: " . $product_code . "');</script>");
    if ($stat == "1") {
        $target_dir = "images/";
        $uploadfile = $_FILES["fileToUpload"]["name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        if ($uploadfile <> '') {
            $sql = "INSERT INTO product_image (image,product_code,modify_date,insert_date) VALUES ('$target_file' , '" . $product_code . "',SYSDATE(),SYSDATE())";
            if ($conn->query($sql) === TRUE) {
                $obj = new phpUploadAddImages();
                $obj->addGDLogoLicense($target_file, 'images/dupimg.png');

            } else {
                $alert = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $alert = "Error: mixmix";
        }
    }
    AddServiceProduct(
        $product_code,
        $product_title_en,
        $product_title_th,
        '',
        '',
        '',
        '',
        '',
        '',
        $cat_product,
        $product_category_title_th,
        $product_category_title_en,
        $detail_prod_th,
        $conn
    );

    //	print($_POST['pathimgs']);


    $conn->close();
}


?>

    <!-- include libs stylesheets -->
    <link href="css/bootstrap4.1.3.css" rel="stylesheet"/>
    <script src="js/popper1.14.5.js"></script>


    <!-- include summernote -->
    <link rel="stylesheet" href="dist/summernote-bs4.css">
    <script type="text/javascript" src="dist/summernote-bs4.js"></script>
    <script src="dist/summernote-image-attributes.js"></script>

    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->

        <form id="myform" action="add_product_blank.php" method="POST" class="form-horizontal" data-parsley-validate=""
              novalidate="" enctype="multipart/form-data">
            <div id="page-wrapper">
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>เพิ่มสินค้าพิเศษ</h2>
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

                    <!--
                    <label>Business Title th</label>
                    <input class="form-control" placeholder="" type="text" name="business_title_th" value="อุปกรณ์จราจร" disabled=true />
                    <br> -->

                    <!-- <label>Product Category Code</label> -->
                    <input class="form-control" placeholder="" type="hidden" name="product_category_code"
                           value="SPECIAL"/>


                    <!-- <label>Product Category Title TH</label> -->
                    <input class="form-control" placeholder="" type="hidden" name="product_category_title_th"
                           value="สินค้าพิเศษ"/>

                    <!-- <label>Product Category Title EN</label> -->
                    <input class="form-control" placeholder="" type="hidden" name="product_category_title_en" value=""/>


                    <label>Product Title EN</label>
                    <input class="form-control" placeholder="" type="text" name="product_title_en" value=""/>
                    <br>
                    <label>Product Title TH</label>
                    <input class="form-control" placeholder="" type="text" name="product_title_th" value=""/>
                    <br>
                    <br>
                    <label>ข้อมูลสินค้า</label>


                    <div class="summernote1"></div>

                    <textarea rows="4" cols="50" style="display:none;" name="detail_prod_th">
						</textarea>
                    <br>


                    <br><br>
                    <!-- Button to select & upload files -->
                    <label>เลือกรูป</label>
                    <font color="red"> รูปควรจะมีขนาดภาพที่เท่ากัน </font>
                    <input type="file" name="fileToUpload" id="fileToUpload">


                    <br/> <br/>
                    </ul>

                    <br>

                    <!-- <label>Product Unit EN</label>
                    <input class="form-control" placeholder="" type="text" name="product_unit_en" value="" />
                    <br>
                    <label>Product Unit TH</label>
                    <input class="form-control" placeholder="" type="text" name="product_unit_th" value="" />
                    <br>
                    <label>Warranty Days <font color="red">กรุณาใส่เฉพาะตัวเลขเท่านั้น</font></label>
                    <input class="form-control" placeholder="" type="text" name="warranty_days" value="" />
                    <br> -->

                    <!--
                        <label>ส่วนลด</label>
                        <input class="form-control" placeholder="" type="text" name="disc" value="" />
                        <br>

                        <label>จำนวนสินค้า</label>
                        <input class="form-control" placeholder="" type="text" name="weight" value="" />
                        <br>
                        -->

                    <!--
                        <label>คุณสมบัติ</label>

                        <textarea cols="80" id="editor2" name="propty" rows="10"></textarea>
                        </textarea>
                        <br>
                        -->
                    <!-- <input type="hidden" id="username_log" value="<? echo $username_log; ?>">
                <input type="hidden" name="action" value="1" />
                <input type="hidden" name="id" value="1" /> -->
                    <input type="hidden" name="action" value="1"/>
                    <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save</button>
                    <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">
                        Reset
                    </button>
                    <a href="javascript:void(0)" onclick="backHome('ma_product_blank.php');" class="btn btn-default">Back</a>


                </div>
                <!-- /. PAGE INNER  -->
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
        </script>

        <script>
            function sumit_edit_product() {
                var summernote1 = $('.summernote1').summernote('code').trim();


                document.getElementsByName("detail_prod_th")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");


                $("#myform").submit();

            }
        </script>
        <?

        include 'footer.php';
        ?>


<?
function AddServiceProduct(
    $product_code,
    $product_title_en,
    $product_title_th,
    $product_unit_en,
    $product_unit_th,
    $warranty_days,
    $product_type_code,
    $product_type_title_th,
    $product_type_title_en,
    $product_category_code,
    $product_category_title_th,
    $product_category_title_en,
    $detail_prod_th,
    $conn
)
{

    $sql = "INSERT INTO product_main (
product_code,
product_title_en,
product_title_th,
product_unit_en,
product_unit_th,
warranty_days,
available_product,
booked_product,
product_type_code,
product_type_title_th,
product_type_title_en,
product_category_code,
product_category_title_th,
product_category_title_en,
sell_with_web,
modify_date,
insert_date,
content_prod_th
) VALUES
('" .
        $product_code . "','" .
        $product_title_en . "','" .
        $product_title_th . "','" .
        $product_unit_en . "','" .
        $product_unit_th . "','" .
        $warranty_days . "','" .
        0 . "','" .
        0 . "','" .
        $product_type_code . "','" .
        $product_type_title_th . "','" .
        $product_type_title_en . "','" .
        $product_category_code . "','" .
        $product_category_title_th . "','" .
        $product_category_title_en . "',
'" . 1 . "',

SYSDATE(),
SYSDATE(),
'" . $detail_prod_th . "'
)";

    if (mysqli_query($conn, $sql)) {
        echo $product['product_code'] . "successfully.";
    } else {
        echo "ERROR: Could not able to execute" . mysqli_error($conn) . $sql;
    }
}

?>