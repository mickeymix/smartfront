<? include 'head.php';
require_once("phpUploadAddImages.php");

file_exists("phpUploadAddImages.php");

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
?>


<!-- include libs stylesheets -->
<link href="css/bootstrap4.1.3.css" rel="stylesheet" />
<script src="js/popper1.14.5.js"></script>


<!-- include summernote -->
<link rel="stylesheet" href="dist/summernote-bs4.css">
<script type="text/javascript" src="dist/summernote-bs4.js"></script>
<script src="dist/summernote-image-attributes.js"></script>


<?



$id = $_GET["id"];

if ($id == "") {

	$id = $_POST["id"];
}

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if ($_POST["action"] == "1") {
	date_default_timezone_set('Asia/Bangkok');
	$dateAtTime = date('m/d/Y h:i:s a', time());
	$stat = "1";
	$detail_prod_th = $_POST["detail_prod_th"];
	$detail_prod_th =	str_replace("youtube-iframe", "www.youtube.com", $detail_prod_th);

	$detail_prod_en = $_POST["detail_prod_en"];
	$detail_prod_en =	str_replace("youtube-iframe", "www.youtube.com", $detail_prod_en);

	$content_prod_th = $_POST["content_prod_th"];
	$content_prod_th =	str_replace("youtube-iframe", "www.youtube.com", $content_prod_th);

	$content_prod_en = $_POST["content_prod_en"];
	$content_prod_en =	str_replace("youtube-iframe", "www.youtube.com", $content_prod_en);

	$headline = $_POST["headline"];
	$sub_headline = $_POST["sub_headline"];

	$freight = $_POST["freight"];
	$website_title = $_POST["website_title"];
	$keyword = $_POST["keyword"];
	$youtube = $_POST["youtube"];
	$tag_google = $_POST["tag_google"];

	$sql = "UPDATE product_main SET 
		content_prod_th = '" . $content_prod_th . "' ,
		content_prod_en = '" . $content_prod_en . "' ,	
		product_description_th = '" . $detail_prod_th . "' ,
		product_description_en = '" . $detail_prod_en . "' , 
		headline = '" . $headline . "' , 
		sub_headline = '" . $sub_headline . "' ,
		freight = '" . $freight . "' ,
		website_title = '" . $website_title . "' ,
		keyword = '" . $keyword . "' ,
		youtube = '" . $youtube . "' ,
		tag_google = '" . $tag_google . "'
		, update_by = '$username_log'
		, update_admin_datetime = '$dateAtTime'
		WHERE product_code='" . $id . "'";



	if ($stat == "1") {
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert = "New record created successfully";
			print(" <center><font color='red'>ประกาศได้ถูกแก้ไขแล้วค่ะ</font></center> ");
		} else {
			$alert = "Error: " . $sql . "<br>" . $conn->error;
			print($alert);
		}
	} else {
		print(" <center><font color='red'>กรุณากรอกข้อมูลให้ครบค่ะ</font></center>");
	}







	if ($stat == "1") {
		$sql = "DELETE FROM product_image WHERE product_code='" . $id . "'";

		if ($conn->query($sql) === TRUE) {
			//$alert="DELETE successfully";
		} else {
			//$alert="Error: " . $sql . "<br>" . $conn->error;
		}







		if ($_POST['pathimgs'] <> "") {



			foreach ($_POST['pathimgs'] as $key => $value) {



				$sql = "INSERT INTO product_image (image,product_code,modify_date,insert_date) VALUES ('$value' , '" . $id . "',SYSDATE(),SYSDATE())";

				if ($conn->query($sql) === TRUE) {
					//	$alert="New record created successfully";
					//	echo $alert;

					$obj = new phpUploadAddImages();
					$obj->addGDLogoLicense($value, 'images/dupimg.png');
				} else {
					//	$alert="Error: " . $sql . "<br>" . $conn->error;
					//	echo $alert;
				}
			}
		}
	}
}


?>



<div id="wrapper">
	<?php include("top.php"); ?>
	<!-- /. NAV TOP  -->
	<?php include("menu.php"); ?>
	<!-- /. NAV SIDE  -->

	<form id="myform" action="edit_product.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="">
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-8">
							<h2>แก้ไขสินค้า</h2>
						</div>
						<div class="col-md-4" align="right">

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
				<br />
				<?


				$sql = "SELECT * FROM product_main WHERE product_code = '$id'   ";


				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) {


					$product_code = $row["product_code"];
					$product_type_title_th = $row["product_type_title_th"];
					$product_category_title_th = $row["product_category_title_th"];


					?>
				<div align="right"> 
				<a target="_blank" href="../product_detail.php?product_code=<? echo $product_code; ?>&product_type_title_th=<? echo $product_type_title_th; ?>&product_category_title_th=<? echo $product_category_title_th; ?>"><img src="images/preview.png" width="150px"> </a>
				<button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save </button> 
				<button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button> 
				<a href="javascript:void(0)" onclick="backHome('ma_product.php');" class="btn btn-default">Back</a> </div> <br />
				

					<br>

					<label>Product Code</label>
					<input class="form-control" placeholder="" type="text" name="nameProduct" disabled="disabled" value="<?= $row["product_code"]; ?>" />
					<br>

					<label>Product Name</label>
					<input class="form-control" placeholder="" type="text" name="nameProduct" disabled="disabled" value="<?= $row["product_title_th"]; ?>" />
					<br>


					<label>Headline</label>
					<input class="form-control" placeholder="" type="text" name="headline" value="<?= $row["headline"]; ?>" />
					<br>

					<label>Sub-Headline</label>
					<input class="form-control" placeholder="" type="text" name="sub_headline" value="<?= $row["sub_headline"]; ?>" />
					<br>

					<label>Script Product</label>
					<textarea class="form-control" name="tag_google" rows="5" cols="150"><?= $row["tag_google"]; ?></textarea>
					<br />

					<label>Freight</label>
					<input class="form-control" placeholder="" type="text" name="freight" value="<?= $row["freight"]; ?>" />
					<br>

					<label>Website_title</label>
					<input class="form-control" placeholder="" type="text" name="website_title" value="<?= $row["website_title"]; ?>" />
					<br>

					<label>Keyword</label>
					<input class="form-control" placeholder="" type="text" name="keyword" value="<?= $row["keyword"]; ?>" />
					<br>


					<label>Description Thai</label>




					<div class="summernote1"><?= $row["product_description_th"]; ?></div>

					<textarea rows="4" cols="50" style="display:none;" name="detail_prod_th">
						</textarea>
					<br>


					<label>Description Eng</label>

					<div class="summernote2"><?= $row["product_description_en"]; ?></div>

					<textarea rows="4" cols="50" style="display:none;" name="detail_prod_en">
						</textarea>
					<br>



					<label>Content Thai</label>

					<div class="summernote3"><?= $row["content_prod_th"]; ?></div>

					<textarea rows="4" cols="50" style="display:none;" name="content_prod_th">
						</textarea>
					<br>


					<label>Content Eng</label>

					<div class="summernote4"><?= $row["content_prod_en"]; ?></div>

					<textarea rows="4" cols="50" style="display:none;" name="content_prod_en">
						</textarea>
					<br>




					<label>Youtube</label>
					<input class="form-control" placeholder="" type="text" name="youtube" value="<?= $row["youtube"]; ?>" />
					<br>


					



				<?

				}

				?>


				<label>Related Product</label>
				<br />
				<input type="text" name="product_code_related" id="product_code_related" />
				<input type="button" value="Add" onclick="addRelated();" />
				<br />

				<div id="relatedView">
					<ul>
						<?

						$sql7 = "SELECT 
									a.product_code_related , a.id_related
									,(SELECT image FROM product_image where a.product_code_related = product_code  LIMIT 1 ) AS img
									FROM product_related a
									WHERE product_code ='" . $product_code . "' 
									ORDER BY  a.insert_date  DESC";

						$result7 = $conn->query($sql7);

						while ($row7 = $result7->fetch_assoc()) {

							?>

							<?= $row7["product_code_related"]; ?>



							<li style="width:130px" onclick="delRelated(<?= $row7["id_related"]; ?>);">
								<img src="<?= $row7["img"]; ?>" width="100px"> <img src="images/close_5.png" width="20px">

							</li>

						<?
						}


						?>
					</ul>
				</div>
				<br />

				<br> <br><br>
				<!-- Button to select & upload files -->
				<span class="btn btn-success fileinput-button">
					<span>อัพรูป...</span>
					<!-- The file input field used as target for the file upload widget -->
					<input id="fileupload" type="file" name="files[]" multiple>
				</span>
				<br>
				<br>



				<br>
				<font color="red"> *หลังจากเพิ่มหรือลบ รูปภาพ กด Save เพื่ออัพเดตฐานข้อมูล </font>
				<ul id="files">
					<?

					$sql6 = "SELECT * FROM  product_image WHERE product_code ='" . $id . "' ORDER BY  id ASC";

					$result6 = $conn->query($sql6);

					while ($row6 = $result6->fetch_assoc()) {

						?>
						<li style="width:130px" onclick="close_img(&quot;<?= $row6["image"]; ?>&quot;,this)">
							<img src="<?= $row6["image"]; ?>" width="100px">
							<img src="images/close_5.png" width="20px">
							<input type="hidden" name="pathimgs[]" value="<?= $row6["image"]; ?>">
						</li>
					<?
					}


					?>
				</ul>

				<br>
				<input type="hidden" id="product_code" value="<? echo $product_code; ?>">
				
				<input type="hidden" id="username_log" value="<? echo $username_log; ?>">
				<input type="hidden" name="action" value="1" />
				<input type="hidden" name="id" value="<? echo $id; ?>" />
				<a target="_blank" href="../product_detail.php?product_code=<? echo $product_code; ?>&product_type_title_th=<? echo $product_type_title_th; ?>&product_category_title_th=<? echo $product_category_title_th; ?>"><img src="images/preview.png" width="150px"> </a>
				<button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save </button>
				<button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
				<a href="javascript:void(0)" onclick="backHome('ma_product.php');" class="btn btn-default">Back</a>




			</div>
			<!-- /. PAGE INNER  -->
		</div>

		<!-- /. PAGE WRAPPER  -->
</div>

</form>

<? $conn->close(); ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.summernote1').summernote({
			popover: {
				image: [
					['custom', ['imageAttributes']],
					['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					['float', ['floatLeft', 'floatRight', 'floatNone']],
					['remove', ['removeMedia']]
				],
			},
			lang: 'en-US', // Change to your chosen language
			imageAttributes: {
				icon: '<i class="note-icon-pencil"/>',
				removeEmpty: true, // true = remove attributes | false = leave empty if present
				disableUpload: true // true = don't display Upload Options | Display Upload Options
			}
		});

		$('.summernote2').summernote({
			popover: {
				image: [
					['custom', ['imageAttributes']],
					['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					['float', ['floatLeft', 'floatRight', 'floatNone']],
					['remove', ['removeMedia']]
				],
			},
			lang: 'en-US', // Change to your chosen language
			imageAttributes: {
				icon: '<i class="note-icon-pencil"/>',
				removeEmpty: true, // true = remove attributes | false = leave empty if present
				disableUpload: true // true = don't display Upload Options | Display Upload Options
			}
		});

		$('.summernote3').summernote({
			popover: {
				image: [
					['custom', ['imageAttributes']],
					['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					['float', ['floatLeft', 'floatRight', 'floatNone']],
					['remove', ['removeMedia']]
				],
			},
			lang: 'en-US', // Change to your chosen language
			imageAttributes: {
				icon: '<i class="note-icon-pencil"/>',
				removeEmpty: true, // true = remove attributes | false = leave empty if present
				disableUpload: true // true = don't display Upload Options | Display Upload Options
			}
		});

		$('.summernote4').summernote({
			popover: {
				image: [
					['custom', ['imageAttributes']],
					['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
					['float', ['floatLeft', 'floatRight', 'floatNone']],
					['remove', ['removeMedia']]
				],
			},
			lang: 'en-US', // Change to your chosen language
			imageAttributes: {
				icon: '<i class="note-icon-pencil"/>',
				removeEmpty: true, // true = remove attributes | false = leave empty if present
				disableUpload: true // true = don't display Upload Options | Display Upload Options
			}
		});

		$('#myform').on('keyup keypress', function(e) {
			var keyCode = e.keyCode || e.which;
			if (keyCode === 13) {
				e.preventDefault();
				return false;
			}
		});

	});
</script>

<script>
	function addRelated() {
		var product_code = $("#product_code").val();
		var product_code_related = $("#product_code_related").val();
		var username_log = $("#username_log").val();

		$.post("AjaxRelatedProduct.php", {
				data1: product_code,
				data2: username_log,
				data3: product_code_related
			},
			function(result) {
				$("#relatedView").html(result);
			}
		);


	}

	function delRelated(id_related) {
		var product_code = $("#product_code").val();

		$.post("AjaxDelRelatedProduct.php", {

				data1: id_related,
				data2: product_code
			},
			function(result) {
				$("#relatedView").html(result);
			}
		);


	}

	function sumit_edit_product() {
		var summernote1 = $('.summernote1').summernote('code').trim();
		var summernote2 = $('.summernote2').summernote('code').trim();
		var summernote3 = $('.summernote3').summernote('code').trim();
		var summernote4 = $('.summernote4').summernote('code').trim();




		document.getElementsByName("detail_prod_th")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");
		document.getElementsByName("detail_prod_en")[0].value = summernote2.replace(/\www.youtube.com/g, "youtube-iframe");
		document.getElementsByName("content_prod_th")[0].value = summernote3.replace(/\www.youtube.com/g, "youtube-iframe");
		document.getElementsByName("content_prod_en")[0].value = summernote4.replace(/\www.youtube.com/g, "youtube-iframe");




		$("#myform").submit();

	}
</script>

<?

include 'footer.php';
?>