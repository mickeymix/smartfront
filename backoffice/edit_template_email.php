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


if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
if ($_POST["action"] == "1") {

	$stat = "1";
	$email_message = $_POST["email_message"];
	$email_message =	str_replace("youtube-iframe", "www.youtube.com", $email_message);


	$email_title = $_POST["email_title"];

	$email_altMessage = $_POST["email_altMessage"];




	$sql = "UPDATE email_teamplate_master SET 
		email_title = '$email_title' 
		, email_message = '$email_message' 		
		, email_altMessage = '$email_altMessage' 
		WHERE email_id = '1'  ";


	if ($stat == "1") {
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;
			$alert = "แก้ไข email template เรียบร้อยแล้ว";
			print(" <center><font color='red'>แก้ไขข้อมูลสำเร็จ</font></center> ");
		} else {
			$alert = "Error: " . $sql . "<br>" . $conn->error;
			print($alert);
		}
	} else {
		print(" <center><font color='red'>กรุณากรอกข้อมูลให้ครบค่ะ</font></center>");
	}
}


?>



<div id="wrapper">
	<?php include("top.php"); ?>
	<!-- /. NAV TOP  -->
	<?php include("menu.php"); ?>
	<!-- /. NAV SIDE  -->

	<form id="myform" action="edit_template_email.php" method="POST" class="form-horizontal" data-parsley-validate="" novalidate="" enctype="multipart/form-data">
		<div id="page-wrapper">
			<div id="page-inner">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-8">
							<h2>ตั้งค่า Email แคตตาล๊อค</h2>
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

				<?


				$sql = "SELECT * FROM email_teamplate_master WHERE email_id = '1'   ";


				$result = $conn->query($sql);
				while ($row = $result->fetch_assoc()) {






					?>


					<label>Email Title</label>
					<input class="form-control" placeholder="" type="text" name="email_title" value="<?= $row["email_title"]; ?>" />
					<br>




					<label>EmailMessage</label>

					<div class="summernote1"><?= $row["email_message"]; ?></div>

					<textarea rows="4" cols="50" style="display:none;" name="email_message"></textarea>
					<br>

					<label>AltMessage</label>
					<input class="form-control" placeholder="" type="text" name="email_altMessage" value="<?php echo $row["email_altMessage"]; ?>" />
					<br>

				
				<?

				}

				?>
				<input type="hidden" name="action" value="1" />
				<button type="button" onclick="sumit_edit_product();" class="btn btn-success"> Save </button>
				<button type="reset" href="javascript:void(0)" onclick="resetDataAll();" class="btn btn-primary">Reset</button>
				<a href="javascript:void(0)" onclick="backHome('ma_product.php');" class="btn btn-default">Back</a>




			</div>
			<!-- /. PAGE INNER  -->
		</div>
    </form>
		<!-- /. PAGE WRAPPER  -->
</div>

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
	function sumit_edit_product() {
		var summernote1 = $('.summernote1').summernote('code').trim();






		document.getElementsByName("email_message")[0].value = summernote1.replace(/\www.youtube.com/g, "youtube-iframe");






		$("#myform").submit();

	}
</script>

<?

include 'footer.php';
?>