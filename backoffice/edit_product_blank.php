<?
include 'head.php';

require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");

?>

<!-- include libs stylesheets -->
<link href="css/bootstrap4.1.3.css" rel="stylesheet" />
<script src="js/popper1.14.5.js"></script>


<!-- include summernote -->
<link rel="stylesheet" href="dist/summernote-bs4.css">
<script type="text/javascript" src="dist/summernote-bs4.js"></script>
<script src="dist/summernote-image-attributes.js"></script>
<?

$id = $_GET["product_code"];

if ($id == "") {

    $id = $_POST["product_code"];
}


if ($_POST["action"] == "1") {

    $product_code = $_POST["product_code"];



    $uploadfile = $_FILES["fileToUpload"]["name"];

    $product_title_en = $_POST["product_title_en"];
    $product_title_th = $_POST["product_title_th"];
    $stat = "1";
    $detail_prod_th = $_POST["detail_prod_th"];
    $detail_prod_th =    str_replace("youtube-iframe", "www.youtube.com", $detail_prod_th);

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

    echo ("<script>console.log('product_code: " . $_FILES['fileToUpload']['name'] . "');</script>");
        
        $sql = "UPDATE product_main SET 
		product_title_en = '" . $product_title_en . "' ,
		product_title_th = '" . $product_title_th . "' ,	
		content_prod_th = '" . $detail_prod_th . "'
		WHERE product_code='" . $product_code . "'";
       
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                $alert = "New record created successfully";
                print(" <center><font color='red'>ประกาศได้ถูกแก้ไขแล้วค่ะ</font></center> ");
            } else {
                $alert = "Error: " . $sql . "<br>" . $conn->error;
                print($alert);
            }


    if ($_POST['pathimgs'] <> "") {



        foreach ($_POST['pathimgs'] as $key => $value) {



            $sql = "INSERT INTO product_image (image,product_code,modify_date,insert_date) VALUES ('$value' , '" . $product_code . "',SYSDATE(),SYSDATE())";

            if ($conn->query($sql) === TRUE) {
                //	$alert="New record created successfully";
                //	echo $alert;

                $obj = new phpUploadAddImages();
                $obj->addGDLogoLicense($value, 'images/dupimg.png');
            } else {
                //	$alert="Error: " . $sql . "<br>" . $conn->error;
                //	echo $alert;
            }
        }
    }
    // AddServiceProduct(
    //     $product_code,
    //     $product_title_en,
    //     $product_title_th,
    //     $product_unit_en,
    //     $product_unit_th,
    //     $warranty_days,
    //     '',
    //     '',
    //     '',
    //     $cat_product,
    //     $product_category_title_th,
    //     $product_category_title_en,
    //     $detail_prod_th,
    //     $conn
    // );

    //	print($_POST['pathimgs']);



    $conn->close();
}


?>


<div id="wrapper">
    <?php include("top.php"); ?>
    <!-- /. NAV TOP  -->
    <?php include("menu.php"); ?>
    <!-- /. NAV SIDE  -->

    <form id="myform" action="edit_product_blank.php?product_code=<?echo $id?>" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="" enctype="multipart/form-data">
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>แก้ไขสินค้าพิเศษ</h2>
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

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
                echo ("<script>console.log('id: " . $id . "');</script>");
                $sql = "SELECT * FROM product_main WHERE product_code = '$id'   ";
                $query = mysqli_query($conn, $sql);
		
                while ($row = mysqli_fetch_assoc($query)) {

                // $result = $conn->query($sql);
                // while ($row = $result->fetch_assoc()) {
                    ?>
                    <div align="right">
                        <a target="_blank" href="../spacial_product.php?product_code=<? echo $id; ?>"><img src="images/preview.png" width="150px"> </a>
                        <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save </button>
                        <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
                        <a href="javascript:void(0)" onclick="backHome('ma_product_blank.php');" class="btn btn-default">Back</a> </div> <br />


                    <!-- 
				        <label>Business Title th</label>
				        <input class="form-control" placeholder="" type="text" name="business_title_th" value="อุปกรณ์จราจร" disabled=true />
				        <br> -->


                    <label>Product Title EN</label>
                    <input class="form-control" placeholder="" type="text" name="product_title_en" value="<? echo $row['product_title_en'] ?>" />
                    <br>
                    <label>Product Title TH</label>
                    <input class="form-control" placeholder="" type="text" name="product_title_th" value="<? echo $row['product_title_th'] ?>" />
                    <br>
                    <br>
                    <label>ข้อมูลสินค้า</label>


                    <div class="summernote1"><?= $row["content_prod_th"]; ?></div>

                    <textarea rows="4" cols="50" style="display:none;" name="detail_prod_th">
						        </textarea>
                    <br>


                    <br><br>
                    <!-- Button to select & upload files -->
                    <span class="btn btn-success fileinput-button">
					<span>อัพรูป...</span>
                        <!-- The file input field used as target for the file upload widget -->
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
                    <br>
                    <br>



                    <br>
                    <font color="red"> *หลังจากเพิ่มหรือลบ รูปภาพ กด Save เพื่ออัพเดตฐานข้อมูล </font>
                    <ul id="files">
                        <?

                        $sql6 = "SELECT * FROM  product_image WHERE product_code ='" . $id . "' ORDER BY  id ASC";

                        $result6 = $conn->query($sql6);

                        while ($row6 = $result6->fetch_assoc()) {

                            ?>
                            <li style="width:130px" onclick="close_img(&quot;<?= $row6["image"]; ?>&quot;,this)">
                                <img src="<?= $row6["image"]; ?>" width="100px">
                                <img src="images/close_5.png" width="20px">
                                <input type="hidden" name="pathimgs[]" value="<?= $row6["image"]; ?>">
                            </li>
                            <?
                        }


                        ?>
                    </ul>


                    <br /> <br />
                    </ul>

                    <br>

                <? } ?>
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
                <input type="hidden" name="action" value="1" />
                <input type="hidden" name="product_code" value="<? echo $id; ?>" />
                <a target="_blank" href="../spacial_product.php?product_code=<? echo $id; ?>"><img src="images/preview.png" width="150px"> </a>
                <button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save </button>
                <button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
                <a href="javascript:void(0)" onclick="backHome('ma_product_blank.php');" class="btn btn-default">Back</a>




            </div>
            <!-- /. PAGE INNER  -->
        </div>

    </form>


    <script type="text/javascript">
        $(document).ready(function() {
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

            $('#myform').on('keyup keypress', function(e) {
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
    ) {

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