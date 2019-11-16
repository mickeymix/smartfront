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
$id = $_GET["id"];
if ($_GET["action"] == "998") {

    $sql = "SELECT menu_img FROM menu WHERE id_menu='" . $id . "'";


    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {


        //	print($row["menu_img"]);

        unlink($row["menu_img"]);
    }

    $sql = "DELETE FROM menu WHERE id_menu ='" . $id . "'";

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


                    <form class="card card-sm" name="myForm" action="ma_menu.php" onsubmit="return validateForm()">
                        <div class="col-12 col-md-12 col-lg-6" style=" padding-right: 0px;">
                            <input class="form-control form-control-lg form-control-borderless" name="menu_keyword"
                                   value="<?php echo $_GET['menu_keyword']; ?>" type="search"
                                   placeholder="ค้นหาจาก menu_keyword">

                        </div>

                        <div class="col-12 col-md-12 col-lg-6" style=" padding-left: 0px;">

                            <button class="btn  btn-success" type="submit">Search</button>

                        </div>


                    </form>

                    <!-- end search -->


                    <div class="col-md-12">
                        <h2>ข้อมูลเมนู</h2>
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
                            <th>Sub</th>
                            <th>Menu Name</th>
                            <th>Keyword</th>
                            <th>imgages</th>
                            <th style="text-align:center; ">แก้ไข</th>
                            <th style="text-align:center; ">ลบ</th>
                            <th style="text-align:center; ">สถานะ</th>

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

                        if (isset($_GET['menu_keyword'])) {
                            $sql = "SELECT * FROM menu WHERE  menu_keyword ='" . $_GET['menu_keyword'] . "'  ORDER BY INSERT_DATE DESC ";
                        } else {
                            $sql = "SELECT * FROM menu    ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
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
                                <td width="45px">
                                    <button onclick="window.location.href='add_submenu.php?id_menu=<?php echo $result['id_menu']; ?>'"
                                            class="btn btn-primary">เพิ่ม
                                    </button>
                                </td>
                                <td><?php echo $result['menu_name']; ?></td>
                                <td><?php echo $result['menu_keyword']; ?>    </td>
                                <td><img src="<?php echo $result['menu_img']; ?>" width="32px"/></td>
                                <td style="text-align:center; width:20px;">
                                    <button class="btn btn-primary"
                                            onClick="javascript:location.href='edit_menu.php?id_menu=<?php echo $result['id_menu']; ?>'">
                                        <i class="fa fa-edit "></i>แก้ไข
                                    </button>
                                </td>
                                <td style="text-align:center; width:20px;">

                                    <button class="btn btn-danger"
                                            onClick="javascript:location.href='ma_menu.php?action=998&id=<?php echo $result['id_menu']; ?>'">
                                        <i class="fa fa-pencil"></i>ลบ
                                    </button>
                                </td>

                                <td style="text-align:center; width:20px;">

                                    <select>
                                        <option <?php if ($result['menu_status'] === "S"){ ?> selected <?php }?> value="S">แสดง</option>
                                        <option <?php if ($result['menu_status'] === "H"){ ?> selected <?php }?> value="H">ไม่แสดง</option>

                                    </select>
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
                                <a href="ma_menu.php?page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $total_page; $i++) { ?>

                                <?
                                if ($i == $page) {
                                    ?>
                                    <li class='active'><a
                                                href="ma_menu.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                } else {
                                    ?>
                                    <li><a href="ma_menu.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?
                                }
                                ?>

                            <?php } ?>
                            <li>
                                <a href="ma_menu.php?page=<?php echo $total_page; ?>" aria-label="Next">
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
    function onClickListener(element){
        var currentRow=$(element).closest("tr");
        var col2=currentRow.find("td:eq(2)").html();
        var coldsdw2=currentRow.find("td:eq(7)").html();

        // var $row = $(this).parents('tr');
        // var gift = $row.find('input[name="item_GiftAidable"]').is(':checked');
        // var desc = $row.find('p[name="menu_name"]').value;
        // alert(coldsdw2)

    }
    $("select").on('change', function() {
        // if($(this).val() === "mercedes") {
        var currentRow=$(this).closest("tr");
        var col2=currentRow.find("td:eq(2)").html();
            // alert($(this).val())
        // alert($(this).val())
        var valueSelect = $(this).val();
        // }
        $.post("update_menu_showhide_ajax.php", {'menustatus': valueSelect,'nameproduct':col2 }, function (result) {
                // alert(result);
            if (result.status === 1) // Success
            {
                alert(result.message);
                // $("#modalRegisterSuccess").modal("toggle");
            } else // Err
            {
                alert(result.message);
            }
            }
        )
    });
    // $(document).ready(function () {
    //     $('.update-allocation').click(function (event) {
    //         var $row = $(this).parents('tr');
    //         var desc = $row.find('p[name="menu_name"]').val();
    //         alert(desc)
    //     }
    // }
    // function onValueChangeMenu(value) {
    //
    //     const selectedProject = $("#select-menu_showhide option:selected").val();
    //     console.log('midmidmwi  '+value.value);
    // }

    // $('#select-menu_showhide').on('change', function() {
    //     alert( $(this).find(":selected").val() );
    // });
    // $('#select-menu_showhide').change(function () {
    //     onValueChangeMenu();
    // })
</script>
<?
$conn->close();
include 'footer.php';
?>