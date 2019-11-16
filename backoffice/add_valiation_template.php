<?
include 'head.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");


if ($_POST["action"] == "1") {
    $vali_name = $_POST["vali_name"];

    $vali_des = $_POST["vali_des"];

    $vali_one = $_POST["vali_one"];
    $vali_two = $_POST["vali_two"];
    $vali_three = $_POST["vali_three"];
    $sql = "INSERT INTO valiation_master (vali_name, vali_des,vali_one,vali_two,vali_three, insert_date ,update_by) 
		VALUES ('$vali_name','$vali_des','$vali_one','$vali_two','$vali_three',SYSDATE(),'$username_log') ";



        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            $alert = "New record created successfully";
            print(" <center><font color='red'>เพิ่ม template สินค้า</font></center> ");
        } else {
            $alert = "Error: " . $sql . "<br>" . $conn->error;
            print($alert);
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

    <form  action="add_valiation_template.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="">
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>เพิ่มสินค้าอิสระ</h2>
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




                <label>ชื่อกลุ่มสินค้า</label>
                <input class="form-control" placeholder="" type="text" name="vali_name" value="" />
                <br>

                <label>ขยายความกลุ่มสินค้า</label>
                <input class="form-control" placeholder="" type="text" name="vali_des" value="" />
                <br>

                <label>ชื่อของเงื่อนไขที่1</label>
                <input class="form-control" placeholder="" type="text" name="vali_one" value="" />
                <br>
                <label>ชื่อของเงื่อนไขที่2</label>
                <input class="form-control" placeholder="" type="text" name="vali_two" value="" />
                <br>
                <label>ชื่อของเงื่อนไขที่3</label>
                <input class="form-control" placeholder="" type="text" name="vali_three" value="" />
                <br>
                <br> <br><br>


                <input type="hidden" name="action" value="1" />
                <button type="submit" class="btn btn-success">  Save  </button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <a href="" class="btn btn-default">Back</a>


            </div>
            <!-- /. PAGE INNER  -->
        </div>

        <!-- /. PAGE WRAPPER  -->


</form>
</div>


<?
include 'footer.php';
?>


