<?
include 'head.php';


$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>

<script>
	function validateForm() {
		var x = document.forms["myForm"]["product_code"].value;
		if (x == "") {

			return false;
		}
	}
</script>


<?
$id  = $_GET["id"];
if ($_GET["action"] == "998") {


	$sql = "DELETE FROM product_promotion WHERE product_code='" . $id . "'";

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


				<form class="card card-sm" name="myForm" action="ma_product_recommen.php" onsubmit="return validateForm()">
					<div class="col-12 col-md-12 col-lg-6" style=" padding-right: 0px;">
						<input class="form-control form-control-lg form-control-borderless" name="product_code" value="<?php echo $_GET['product_code']; ?>" type="search" placeholder="ค้นหาจาก รหัสสินค้า">

					</div>

					<div class="col-12 col-md-12 col-lg-6" style=" padding-left: 0px;">

						<button class="btn  btn-success" type="submit">Search</button>

					</div>


				</form>

				<!-- end search -->


				<div class="col-md-12">
					<h2>ข้อมูลสินค้าแนะนำ</h2>
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
							<th>รหัสสินค้า</th>
							<th>ประเภท</th>
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

						if (isset($_GET['product_code'])) {
							$sql = "SELECT * FROM product_promotion WHERE  product_code ='" . $_GET['product_code'] . "' AND product_promo_type = 'recommen' ORDER BY INSERT_DATE DESC ";
						} else {
							$sql = "SELECT * FROM product_promotion WHERE product_promo_type = 'recommen'  ORDER BY INSERT_DATE DESC limit {$start} , {$perpage}";
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
								<td><?php echo $result['product_code']; ?> </td>
								<td><?php echo $result['product_promo_type']; ?> </td>


								<td style="text-align:center; width:20;">

									<button class="btn btn-danger" onClick="javascript:location.href='ma_product_recommen.php?action=998&id=<?php echo $result['product_code']; ?>'"><i class="fa fa-pencil"></i>ลบ</button>
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

				if (!isset($_GET['product_code'])) {

					$sql2 = "SELECT * FROM product_promotion WHERE product_promo_type = 'recommen'";
					$query2 = mysqli_query($conn, $sql2);
					$total_record = mysqli_num_rows($query2);
					$total_page = ceil($total_record / $perpage);
					?>
					<nav>
						<ul class="pagination">
							<li>
								<a href="ma_product_recommen.php?page=1" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
							</li>
							<?php for ($i = 1; $i <= $total_page; $i++) { ?>

								<?
								if ($i == $page) {
									?>
									<li class='active'><a href="ma_product_recommen.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?
								} else {
									?>
									<li><a href="ma_product_recommen.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
								<?
								}
								?>

							<?php } ?>
							<li>
								<a href="ma_product_recommen.php?page=<?php echo $total_page; ?>" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
							</li>
						</ul>
					</nav>

				<?php

				}
				?>
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