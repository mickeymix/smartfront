<?
include 'head.php';
?>

<?

if ($_POST["action"] == "1") {

	$last_id = "";

	$cat_product = $_POST["product_category_code"];
	$product_category_title_th = $_POST["product_category_title_th"];
	$product_category_title_en = $_POST["product_category_title_en"];
	$product_code = $_POST["product_code"];
	$product_title_en = $_POST["product_title_en"];
	$product_title_th = $_POST["product_title_th"];
	$product_unit_en = $_POST["product_unit_en"];
	$product_unit_th = $_POST["product_unit_th"];
	$warranty_days = $_POST["warranty_days"];
	





	// Create connection
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	mysqli_set_charset($conn, "utf8");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	// $product_code,
	// $product_title_en,
	// $product_title_th,
	// $product_unit_en,
	// $product_unit_th,
	// $warranty_days,
	// $product_type_code,
	// $product_type_title_th,
	// $product_type_title_en,
	// $product_category_code,
	// $product_category_title_th,
	// $product_category_title_en,
	// $conn

	echo("<script>console.log('product_code: ".$product_code."');</script>");
	
	AddServiceProduct($product_code,$product_title_en,$product_title_th,$product_unit_en,$product_unit_th,$warranty_days,
	'','','',$cat_product,$product_category_title_th,$product_category_title_en,$conn);
	
	//	print($_POST['pathimgs']);


	$conn->close();
}


?>
<script src="js/ckeditor.js"></script>
<script src="js/sample.js"></script>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<div id="wrapper">
	<?php include("top.php"); ?>
	<!-- /. NAV TOP  -->
	<?php include("menu.php"); ?>
	<!-- /. NAV SIDE  -->

	<form action="add_product.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="">
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<h2>เพิ่มสินค้า</h2>
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

<!-- 
				<label>Business Title th</label>
				<input class="form-control" placeholder="" type="text" name="business_title_th" value="อุปกรณ์จราจร" disabled=true />
				<br> -->

				<label>Product Category Code</label>
				<input class="form-control" placeholder="" type="text" name="product_category_code" value="" />
				<br>

				<label>Product Category Title TH</label>
				<input class="form-control" placeholder="" type="text" name="product_category_title_th" value="" />
				<br>
				<label>Product Category Title EN</label>
				<input class="form-control" placeholder="" type="text" name="product_category_title_en" value="" />
				<br>

				<label>Product Code</label>
				<input class="form-control" placeholder="" type="text" name="product_code" value="" />
				<br>
				<label>Product Title EN</label>
				<input class="form-control" placeholder="" type="text" name="product_title_en" value="" />
				<br>
				<label>Product Title TH</label>
				<input class="form-control" placeholder="" type="text" name="product_title_th" value="" />
				<br>

				<label>Product Unit EN</label>
				<input class="form-control" placeholder="" type="text" name="product_unit_en" value="" />
				<br>
				<label>Product Unit TH</label>
				<input class="form-control" placeholder="" type="text" name="product_unit_th" value="" />
				<br>
				<label>Warranty Days <font color="red">กรุณาใส่เฉพาะตัวเลขเท่านั้น</font></label>
				<input class="form-control" placeholder="" type="text" name="warranty_days" value="" />
				<br>

				<!--
					<label>ส่วนลด</label>
					<input class="form-control" placeholder="" type="text" name="disc" value="" />
					<br> 
				
					<label>จำนวนสินค้า</label>
					<input class="form-control" placeholder="" type="text" name="weight" value="" />
					<br>
					-->

				<!--	
					<label>คุณสมบัติ</label>
				
					<textarea cols="80" id="editor2" name="propty" rows="10"></textarea>
					</textarea>
					<br> 
					-->
				<br> <br><br>

				<input type="hidden" name="action" value="1" />
				<button type="submit" class="btn btn-success"> Save </button>
				<button type="reset" class="btn btn-primary">Reset</button>
				<a href="" class="btn btn-default">Back</a>


			</div>
			<!-- /. PAGE INNER  -->
		</div>

		<!-- /. PAGE WRAPPER  -->
</div>

</form>

<script data-sample="1">
	CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
</script>

<?
include 'footer.php';
?>
<?
function AddServiceProduct(
	$product_code,
	$product_title_en,
	$product_title_th,
	$product_unit_en,
	$product_unit_th,
	$warranty_days,
	$product_type_code,
	$product_type_title_th,
	$product_type_title_en,
	$product_category_code,
	$product_category_title_th,
	$product_category_title_en,
	$conn
) {

	$sql = "INSERT INTO product_main (
product_code,
product_title_en,
product_title_th,
product_unit_en,
product_unit_th,
warranty_days,
available_product,
booked_product,
product_type_code,
product_type_title_th,
product_type_title_en,
product_category_code,
product_category_title_th,
product_category_title_en,
sell_with_web,
modify_date,
insert_date
) VALUES
('" .
		$product_code . "','" .
		$product_title_en . "','" .
		$product_title_th . "','" .
		$product_unit_en . "','" .
		$product_unit_th . "','" .
		$warranty_days . "','" .
		0 . "','" .
		0 . "','" .
		$product_type_code . "','" .
		$product_type_title_th . "','" .
		$product_type_title_en . "','" .
		$product_category_code . "','" .
		$product_category_title_th . "','" .
		$product_category_title_en . "',
'" . 1 . "',

SYSDATE(),
SYSDATE()
)";

	if (mysqli_query($conn, $sql)) {
		echo $product['product_code'] . "successfully.";
	} else {
		echo "ERROR: Could not able to execute" . mysqli_error($conn);
	}
}

?>