<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>

<?
$actionID = $_GET['action'];
if ($actionID == 'add') {

    $MenuName = $_GET['menuInput'];

    $sql = "INSERT INTO common_smart_master (common_menu)
            VALUES ('$MenuName')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        $alert = "ได้เพิ่มเมนูช่วยเหลือใหม่เรียบร้อย";
    } else {
        $alert = "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    $url = strtok($url, '?');
    ?>
    <!-- <script langauge="javascript">
         $(document).ready(function(){
   var href = window.location.href,
   
       newUrl = href.substring(0, href.indexOf('&'))
       newUrl = href.substring(0, href.indexOf('?'))
       location.href = newUrl
   window.history.replaceState({}, '', newUrl);
    window.location.reload();
});
//          function remove_querystring_var($url, $key) { 
// 	$url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&'); 
// 	$url = substr($url, 0, -1); 
// 	return $url; 
// }
// window.location.reload();
</script> -->
<?
}

if($_GET['action'] == '998') {

    $idVal = $_GET['id'];

    $sql ="DELETE FROM common_smart_master WHERE common_smart_id ='".$idVal."'";
			
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

                <!-- search -->


                <form class="card card-sm" name="myForm" action="ma_help_service.php" onsubmit="return validateForm()">
                    <div class="col-12 col-md-12 col-lg-6" style=" padding-right: 0px;">
                        <input class="form-control form-control-lg form-control-borderless" name="common_menu" value="<?php echo $_GET['common_menu']; ?>" type="search" placeholder="ค้นหาจาก รหัสสินค้า">

                    </div>

                    <div class="col-12 col-md-12 col-lg-6" style=" padding-left: 0px;">

                        <button class="btn  btn-success" type="submit">Search</button>

                    </div>


                </form>

                <!-- end search -->


                <div class="col-lg-6">
                    <h2>เพิ่มเมนูศูนย์ช่วยเหลือ</h2>
                </div>
                <div class="col-lg-6">
                    <div align="right" style="padding-right: 50px">
                        <button type="button" data-toggle="modal" data-target="#modalLoginForm" class="btn btn-primary">เพิ่ม Logo ใหม่</button>
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
                            <th>ชื่อเมนู</th>
                            <th>Link เมนู</th>
                            <th style="text-align:center; ">ลบ</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        // $perpage = 100;
                        // if (isset($_GET['page'])) {
                        //     $page = $_GET['page'];
                        // } else {
                        //     $page = 1;
                        // }

                        // $start = ($page - 1) * $perpage;

                        // if (isset($_GET['common_menu'])) {
                        //     $sql = "SELECT * FROM common_smart_master WHERE  common_menu ='" . $_GET['common_menu'] . "'";
                        // } else {
                        $conn = mysqli_connect($host, $user, $pass, $dbname);

                        mysqli_set_charset($conn, "utf8");
                        $sql = "SELECT * FROM common_smart_master ORDER BY common_menu";
                        // }

                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

                        $i = 0;
                        while ($result = mysqli_fetch_assoc($query)) {
                            $i++;
                            ?>
                            <tr>
                                <td><? echo $i ?></td>
                                <td><?php echo $result['common_menu']; ?> </td>
                                <td>https://roadsafetyproduct.com/service_menu.php?common_smart_id=<?php echo $result['common_smart_id']; ?> </td>


                                <td style="text-align:center; width:20;">

                                    <button class="btn btn-danger" onClick="javascript:location.href='ma_help_service.php?action=998&id=<?php echo $result['common_smart_id']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
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
        var email = $("#subNameForm3").val();
        if (email == "") {
            alert("กรุณาเพิ่มชื่อเมนู");

            return false;
        }

        var url_page = "";
        var url_page = "ma_help_service.php";
        location.href = url_page + "?action=add&menuInput=" + email;

    }
</script>

<?
$conn->close();
include 'footer.php';
?>