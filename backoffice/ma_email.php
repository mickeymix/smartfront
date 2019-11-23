<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>


    <script>
        $(function () {


            var availableTags = [
                <?php
                $sql = "SELECT keyword FROM email_customer  ORDER BY INSERT_DATE DESC ";
                $query = mysqli_query($conn, $sql);
                $keyword = "";
                while ($result = mysqli_fetch_assoc($query)) {
                    $keyword .= "'" . $result['keyword'] . "',";
                }
                echo rtrim($keyword, ",");
                ?>
            ];


            $("#emailcs").autocomplete({
                source: availableTags
            });
        });
    </script>

<?
$id = $_GET["id"];
if ($_GET["action"] == "998") {


    $sql = "DELETE FROM email_customer WHERE id_email ='" . $id . "'";

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

                    <!-- search -->
                    <form class="card card-sm" name="myForm" action="ma_email.php" onsubmit="return validateForm()">
                        <div class="col-12 col-md-12 col-lg-3" style=" padding-right: 0px;">
                            <input class="form-control form-control-lg form-control-borderless" id="emailcs"
                                   name="keyword" value="<?php echo $_GET['keyword']; ?>" type="search"
                                   placeholder="ค้นหา Email">

                        </div>
                        <div class="col-12 col-md-12 col-lg-2" style=" padding-right: 0px;">

                            <div class="input-group">

                                <input type="text" name="start_date" id="datepicker"
                                       value="<?php echo $_GET['start_date']; ?>" placeholder="เริ่ม"/>
                                <label class=" " for="date" style="background-color: #cbcdd1;">
                                    <span class="fa fa-calendar d1 open-datetimepicker"></span>
                                </label>


                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-2" style=" padding-right: 0px;">

                            <div class="input-group">

                                <input type="text" name="end_date" id="datepicker2"
                                       value="<?php echo $_GET['end_date']; ?>" placeholder="สิ้นสุด"/>
                                <label class=" " for="date" style="background-color: #cbcdd1;">
                                    <span class="fa fa-calendar d2 open-datetimepicker"></span>
                                </label>


                            </div>
                        </div>

                        <div class="col-12 col-md-12 col-lg-3" style=" padding-left: 0px;">

                            <button class="btn  btn-success" type="submit">Search</button>

                        </div>
                        <div class="col-12 col-md-12 col-lg-2" style=" padding-left: 0px;">
                            <?php


                            if ($_GET['keyword'] == "" && $_GET['start_date'] == "" && $_GET['end_date'] == "") {
                                $sql = "SELECT * FROM email_customer  ORDER BY INSERT_DATE DESC ";
                            } else if (isset($_GET['keyword'])) {

                                $sql = "SELECT * FROM email_customer 
								WHERE  keyword like '%" . $_GET['keyword'] . "%' ";

                                if ($_GET['start_date'] != "" && $_GET['end_date'] != "") {
                                    $sql = $sql . " AND insert_date BETWEEN '" . $_GET['start_date'] . "'  
								AND  '" . $_GET['end_date'] . "'  ORDER BY INSERT_DATE DESC ";
                                }

                            } else {
                                $sql = "SELECT * FROM email_customer  ORDER BY INSERT_DATE DESC ";
                            }
                            $query = mysqli_query($conn, $sql);

                            $filName = "customer.csv";
                            $objWrite = fopen("customer.csv", "w");
                            while ($result = mysqli_fetch_assoc($query)) {
                                $csv_email = $result['email'];
                                $csv_keyword = $result['keyword'];
                                $csv_insert_date = $result['insert_date'];
                                fwrite($objWrite, "\"$csv_email\",\"$csv_keyword\",\"$csv_insert_date\" \n");
                            }
                            fclose($objWrite);
                            echo "<br>Generate CSV Done.<br><a href=$filName>Download</a>";
                            ?>
                        </div>
                    </form>


                    <!-- end search -->


                    <div class="col-md-12">
                        <h2>ข้อมูล Email</h2>
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

                <div style="height:10px;"></div>
                <div class="table-responsive">


                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th>ชื่อลูกค้า</th>
                            <th>Email</th>
                            <th>Keyword</th>
                            <th>Date</th>
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
                        if ($_GET['keyword'] == "" && $_GET['start_date'] == "" && $_GET['end_date'] == "") {
                            $sql = "SELECT * FROM email_customer  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
                        } else if (isset($_GET['keyword'])) {

                            $sql = "SELECT * FROM email_customer 
	WHERE  keyword like '%" . $_GET['keyword'] . "%' ";

                            if ($_GET['start_date'] != "" && $_GET['end_date'] != "") {
                                $sql = $sql . " AND insert_date BETWEEN '" . $_GET['start_date'] . "'  
	AND  '" . $_GET['end_date'] . "'  ORDER BY INSERT_DATE DESC ";
                            }

                        } else {
                            $sql = "SELECT * FROM email_customer  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
                        }


                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++;
                            ?>
                            <tr>
                                <td><? echo $i ?></td>
                                <td><?php echo $result['customer_name']; ?>    </td>
                                <td><?php echo $result['email']; ?>    </td>
                                <td><?php echo $result['keyword']; ?>    </td>
                                <td><?php echo $result['insert_date']; ?>    </td>
                                <td style="text-align:center; width:20px;">

                                    <button class="btn btn-danger"
                                            onClick="javascript:location.href='ma_email.php?action=998&id=<?php echo $result['id_email']; ?>'">
                                        <i class="fa fa-pencil"></i>ลบ
                                    </button>
                                </td>

                            </tr>
                            <?
                        }

                        ?>

                        </tbody>
                    </table>

                    <?php

                    if ($i == 0) {

                        echo "not found.";
                    }


                    $sql2 = "SELECT * FROM menu ";
                    $query2 = mysqli_query($conn, $sql2);
                    $total_record = mysqli_num_rows($query2);
                    $total_page = ceil($total_record / $perpage);
                    ?>
                    <nav>
                        <ul class="pagination">
                            <li>
                                <a href="ma_email.php?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>

                                <?
                                if ($i == $page) {
                                    ?>
                                    <li class='active'><a
                                                href="ma_email.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                } else {
                                    ?>
                                    <li><a href="ma_email.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                }
                                ?>

                            <?php } ?>
                            <li>
                                <a href="ma_email.php?page=<?php echo $total_page; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <script>
        $(function () {
            $("#datepicker2").datepicker({dateFormat: 'yy-mm-dd'});
            $('.d2').click(function () {
                $("#datepicker2").focus();
            });
        });

    </script>

<?
$conn->close();
include 'footer.php';
?>