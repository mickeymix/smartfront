<? include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
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
                        <h2>ข้อมูล Lead Customer</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr/>
                <div style="height:10px;"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                        <tr>
                            <th>#</th>
                            <th>ชื่่อ Paper</th>
                            <th>ดูรายละเอียด</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $sql = "SELECT * FROM white_paper_master";
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++
                            ?>

                            <tr>

                                <td>
                                    <? echo $i ?>
                                </td>
                                <td><?php echo $result['paper_name']; ?> </td>
                                <td>
                                    <button class="btn btn-danger"
                                            onClick="javascript:location.href='detail_paper_summary.php?paper_id=<?php echo $result['paper_id']; ?>'">
                                        <i class="fa fa-insert "></i>รายละเอียด
                                    </button>
                                </td>

                            </tr>

                        <? } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

<?
$conn->close();
include 'footer.php';
?>