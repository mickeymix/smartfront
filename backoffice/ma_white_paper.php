<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>


<?


if($_GET['action'] == '998') {

    $idVal = $_GET['id'];
    $pathFile = $_GET['filepath'];

    $sql ="DELETE FROM white_paper_master WHERE paper_id ='".$idVal."'";

    $flgDelete = unlink($pathFile);

    if ($conn->query($sql) === TRUE) {
        $alert="DELETE successfully";
    } else {
        $alert="Error: " . $sql . "<br>" . $conn->error;
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


                    <div class="col-lg-6">
                        <h2>เพิ่ม white paper</h2>
                    </div>
                    <div class="col-lg-6">
                        <div align="right" style="padding-right: 50px">
                            <button type="button" onclick="onClickSubmitMenu()" class="btn btn-primary">เพิ่ม paper ใหม่</button>
                        </div>
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
                            <th>ชื่อ paper</th>
                            <th>Link Paper</th>
                            <th style="text-align:center; ">ลบ</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        $conn = mysqli_connect($host, $user, $pass, $dbname);

                        mysqli_set_charset($conn, "utf8");
                        $sql = "SELECT * FROM white_paper_master WHERE paper_id != 3 ORDER BY paper_name";


                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++;
                            ?>
                            <tr>
                                <td><? echo $result['paper_id']; ?></td>
                                <td><?php echo $result['paper_name']; ?> </td>
                                <td><p>https://roadsafetyproduct.com/white_paper/<?php echo $result['paper_link'];?></p></td>


                                <td style="text-align:center; width:20px;">

                                        <button class="btn btn-danger" onClick="javascript:location.href='ma_white_paper.php?action=998&id=<?php echo $result['paper_id'];?>&filepath=<? echo $result['paper_link']?>'"><i class="fa fa-pencil"></i>ลบ</button>
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
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">เพิ่มเมนูศูนย์ช่วยเหลือ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">

                        <label data-error="wrong" data-success="right" for="defaultForm-email">ชื่อเมนู</label><br>
                        <input type="text" id="subNameForm3">

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-default" onclick="onClickSubmitMenu()">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function onClickSubmitMenu() {

            location.href = "add_paper_smart.php";

        }
    </script>

<?
$conn->close();
include 'footer.php';
?>