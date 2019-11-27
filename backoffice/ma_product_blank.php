<?
include 'head.php';
?>



<script src="js/ckeditor.js"></script>
<script src="js/sample.js"></script>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<?

if ($_GET["action"] == "998") {
    $id  = $_GET["product_code"];
	$sql = "SELECT image FROM product_image WHERE product_code='" . $id . "'";


	$result = $conn->query($sql);

	while ($row = $result->fetch_assoc()) {


		print($row["image"]);

		unlink($row["image"]);
	}

	$sql = "DELETE FROM product_image WHERE product_code='" . $id . "'";

	if ($conn->query($sql) === TRUE) {
		$alert = "DELETE successfully";
	} else {
		$alert = "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "DELETE FROM product_main WHERE product_code='" . $id . "'";

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
    <div id="page-wrapper">
        <div id="page-inner">
            <div class="row">

                <div class="col-lg-6">
                    <h2>ข้อมูลสินค้าพิเศษ</h2>
                </div>
                <div class="col-lg-6">
                    <div align="right" style="padding-right: 50px">
                        <button type="button" onClick="javascript:location.href='add_product_blank.php'" class="btn btn-primary">เพิ่ม สินค้าใหม่</button>
                    </div>
                </div>


            </div>

            <div style="height:10px;"></div>
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">

                <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อสินค้า</th>
                            <th>LINK</th>

                            <th style="text-align:center; ">แก้ไข</th>
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


                        $sql = "SELECT * FROM product_main  WHERE sell_with_web ='1' AND product_category_code = 'SPECIAL' ORDER BY TRIM(product_title_th)";


                        $query = mysqli_query($conn, $sql);
                        ?>
                        <?

						$i = 0;
						while ($result = mysqli_fetch_assoc($query)) {
							$i++;

							// if($result['sell_with_web'] ==1){
							?>

<tr>
                                <td><? echo $i ?></td>

                                <td><?php echo $result['product_title_th']; ?> </td>

                                <td>https://roadsafetyproduct.com/spacial_product.php?product_code=<?php echo $result['product_code']; ?> </td>

                                <td style="text-align:center; width:20;">
                                    <button class="btn btn-primary" onClick="javascript:location.href='edit_product_blank.php?product_code=<?php echo $result['product_code']; ?>'"><i class="fa fa-edit "></i>แก้ไข</button>
                                </td>
                                <td style="text-align:center; width:20;">

                                    <button class="btn btn-danger" onClick="javascript:location.href='ma_product_blank.php?action=998&product_code=<?php echo $result['product_code']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
                                </td>

                            </tr>
                        <?
                        }

                        ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<?

include 'footer.php';
?>