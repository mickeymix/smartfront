<?php

include 'head.php';

$paper_id = $_GET["paper_id"];


$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");
?>

    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <div id="wrapper">
        <?php include("top.php"); ?>
        <!-- /. NAV TOP  -->
        <?php include("menu.php"); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div style="height:10px;"></div>
    
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">

                        <thead>

                        <tr>
                            <th>#</th>
                            <th>ชื่อ</th>
                            <th>Email</th>
                            <th>เลขที่เอกสาร</th>
                            <th>หน้าที่กด</th>
                            <th>Re-marketing</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?
                        $sql = "SELECT * FROM white_paper_download_master";
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++
                            ?>

                            <tr>

                                <td>
                                    <? echo $i ?>
                                </td>
                                <td><?php echo $result['download_name']; ?> </td>
                                <td><?php echo $result['download_email']; ?> </td>
                                <td><?php echo $result['download_paperid']; ?> </td>
                                <td><?php echo $result['download_source']; ?> </td>
                                <td>
                                    <button class="btn btn-success"><i class="fa fa-insert "></i>Re-marketing</button>
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
include 'footer.php';?>