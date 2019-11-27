<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>

    <script>
        function validateForm() {
            var x = document.forms["myForm"]["menu_keyword"].value;
            if (x == "") {

                return false;
            }
        }
    </script>


<?
$id  = $_GET["id"];
if ($_GET["action"] == "998") {


    $sql = "DELETE FROM valiation_master WHERE vali_id ='" . $id . "'";

    if ($conn->query($sql) === TRUE) {
        $alert = "DELETE successfully";
    } else {
        $alert = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">





                <div class="row">




                    <div class="col-md-12">
                        <h2>หน้าจัดการเลือกสินค้าอิสระ</h2>
                    </div>
                    <div align="right" style="padding-right: 50px">
                        <button type="button" onClick="javascript:location.href='add_valiation_template.php'" class="btn btn-primary">เพิ่ม template Valiation</button>
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

                <div style="height:10px;"></div>
                <div class="table-responsive">



                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>ชื่อกลุ่มสินค้า</th>
                            <th>รายละเอียดกลุ่มสินค้า</th>
                            <th style="text-align:center; ">กำหนดคำตอบ</th>
                            <th style="text-align:center; ">ลบ</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $perpage = 100;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $start = ($page - 1) * $perpage;


                        $sql = "SELECT * FROM valiation_master ";


                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++;
                            ?>
                            <tr>

                                <td><?php echo $result['vali_id']; ?> </td>
                                <td><?php echo $result['vali_name']; ?> </td>
                                <td><?php echo $result['vali_des']; ?> </td>
                                <td style="text-align:center; width:20px;">
                                    <button class="btn btn-primary" onClick="javascript:location.href='add_valiation_tempate_answer.php?id=<?php echo $result['vali_id']; ?>'"><i class="fa fa-edit "></i>กำหนดตำตอบ</button>
                                </td>
                                <td style="text-align:center; width:20px;">

                                    <button class="btn btn-danger" onClick="javascript:location.href='ma_valiation_product.php?action=998&id=<?php echo $result['vali_id']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
                                </td>

                            </tr>
                            <?
                        }

                        ?>

                        </tbody>
                    </table>


                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>

<?
$conn->close();
include 'footer.php';
?>