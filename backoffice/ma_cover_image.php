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

if ($_GET["action"] == "998") {

    $id  = $_GET["coverid"];
    $sql = "SELECT coverImage FROM cover_image_title WHERE coverid='" . $id . "'";


    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

        unlink($row["coverImage"]);
    }

    $sql = "DELETE FROM cover_image_title WHERE coverid ='" . $id . "'";

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
                    <h2>หน้าจัดการ Cover หน้าแรก</h2>
                </div>
                <div align="right" style="padding-right: 50px">
                <button type="button" onClick="javascript:location.href='add_cover_image.php'" class="btn btn-primary">เพิ่ม cover ใหม่</button>
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
                            <th>#</th>
                            <th>Image</th>
                            <th>LINK</th>

                            <th style="text-align:center; ">แก้ไข</th>
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


                        $sql = "SELECT * FROM cover_image_title ";


                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++;
                            ?>
                            <tr>
                                <td><? echo $i ?></td>

                                <td><img src="<?php echo $result['coverImage']; ?>" width="70px"> </td>
                                <td><?php echo $result['coverlink']; ?> </td>

                                <td style="text-align:center; width:20;">
                                    <button class="btn btn-primary" onClick="javascript:location.href='edit_cover_image.php?coverid=<?php echo $result['coverid']; ?>'"><i class="fa fa-edit "></i>แก้ไข</button>
                                </td>
                                <td style="text-align:center; width:20;">

                                    <button class="btn btn-danger" onClick="javascript:location.href='ma_cover_image.php?action=998&coverid=<?php echo $result['coverid']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
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