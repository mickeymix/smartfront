<? ob_start(); ?>
<? session_start();

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>ร้านไทยจราจร</title>

    <?

    require_once("header.php");

    require_once("account/login_user.php");
    
    ?>

<style>
@media screen and (min-width:830px) {
   .cf7_custom_style_1 {
      padding-left: 25%;
      padding-right: 25%;
   }
}

@media screen and (min-width:0)and (max-width:699px) {
   .cf7_custom_style_1 {
      padding-left: 8%;
      padding-right: 8%;
   }
}
@media screen and (min-width:700px)and (max-width:829px) {
   .cf7_custom_style_1 {
      padding-left: 8%;
      padding-right: 8%;
   }
}
</style>

</head>

<body>

    <?php
    include 'backoffice/conn.php';
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    mysqli_set_charset($conn, "utf8");
    ?>
<? $conn = mysqli_connect($host, $user, $pass, $dbname);
			mysqli_set_charset($conn, "utf8");
			$sql = "SELECT * FROM email_menu_config_master WHERE email_menu_id ='3'";
			$query = mysqli_query($conn, $sql);
			while ($result = mysqli_fetch_assoc($query)) {		?>

				<div class="modal fade" id="modalSubscriptionSuccessOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">

								<button type="button" class="close model_close_right" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<img src="backoffice/<? echo $result['email_image_title'] ?>" />

							</div>
							<div class="modal-body mx-3">
								<div class="row">

									<div class="col-md">
										<a target="_blank" href="<? echo $result['email_success_link'] ?>"><img src="backoffice/<? echo $result['email_success_dialog_image'] ?>" /></a>
									</div>


								</div>

							</div>

						</div>
					</div>
				</div>
			<? } ?>

<!--    <div class="content-wrapper row">-->
<!--        <main class="main container" role="main">-->
<!---->
<!--            <div id="myCarousel" class="carousel slide">-->
<!--                -->
<!--                <div class="carousel-inner">-->
<!--                    --><?php
//
//                    $sql = "SELECT * FROM cover_image_title";
//                    $query = mysqli_query($conn, $sql);
//                    $i = 0;
//                    while ($result = mysqli_fetch_assoc($query)) {
//                        if ($i == 0) {
//                            ?>
<!--                            <div class="item active" style="width: 100%; height: auto;">-->
<!--                                <div class="row"><a href="--><?// echo $result['coverlink'] ?><!--"> <img style="width: 100%; height: auto;" src="backoffice/--><?// echo $result['coverImage'] ?><!--" alt="--><?// echo $result['coveralt'] ?><!--"> </a></div>-->
<!--                            </div>-->
<!--                        --><?// } else { ?>
<!--                            <div class="item" style="width: 100%; height: auto;">-->
<!--                                <div class="row"><a href="--><?// echo $result['coverlink'] ?><!--"> <img style="width: 100%; height: auto;" src="backoffice/--><?// echo $result['coverImage'] ?><!--" alt="--><?// echo $result['coveralt'] ?><!--"> </a></div>-->
<!--                            </div>-->
<!--                        --><?// } ?>
<!--                        --><?//
//                        $i++;
//                    } ?>
<!---->
<!--                 -->
<!--                </div>-->
<!--                <p><a href="#myCarousel" class="left carousel-control" data-slide="prev"><span class="icon-prev"></span><span class="sr-only">Previous</span></a><a href="#myCarousel" class="right carousel-control" data-slide="next"><span class="icon-next"></span><span class="sr-only">Next</span></a></p>-->
<!---->
<!---->
<!--            </div>-->
<!--        </main>-->
<!--    </div>-->
    <?php if (isset($_SESSION['customer_id']) && !empty($_SESSION['customer_id'])) {   ?>


    <? } else { ?>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <img src="https://img.lovepik.com/element/40087/8190.png_1200.png" width="40px" />
            ยินดีด้วยคุณได้รับคูปองส่วนลด <U> <a href="javascript:void(0)" onclick="messlide();">คลิกเลย </a></U>
        </div>

    <? } ?>

    <div class="w3-container w3-center">


        <img src="images/10_order_management_1_2.png" width="15%"/><br><br>

        <h2>ขอใบเสนอราคาด่วน (ไม่เกิน 5 นาที)</h2>
    </div>

    <br><br>

    <div class="content-wrapper row">


    <div class="w3-row cf7_custom_style_1">
    <div class="w3-row">
            <div class="w3-col m4"><label style=" font-size: 20px;">ชื่อบริษัท | ชื่อหน่วยงาน</label></div>
            <div class="w3-col m8"><input style="box-shadow: 0 0 3px #000000; margin: 10px " class="w3-input" id="com_name" name="com_name" type="text"></div>
        </div>


        <br>
        <div class="w3-row">
            <div class="w3-col m4"><label style=" font-size: 20px;">ชื่อผู้ติดต่อ</label></div>
            <div class="w3-col m8"> <input style="box-shadow: 0 0 3px #000000; margin: 10px " class="w3-input" id="contact" name="contact" type="text"></div>
        </div>
        <br>

        <div class="w3-row">
            <div class="w3-col m4"><label style=" font-size: 20px;">Email</label></div>
            <div class="w3-col m8"> <input style="box-shadow: 0 0 3px #000000; margin: 10px " class="w3-input" id="email_name" name="email_name" type="text"></div>
        </div>
        <br>
        <div class="w3-row">
            <div class="w3-col m4"><label style=" font-size: 20px;">เบอร์ติดต่อกลับ</label></div>
            <div class="w3-col m8"> <input style="box-shadow: 0 0 3px #000000; margin: 10px " class="w3-input" id="phone_input" name="phone_input" type="number"></div>
        </div>
        <br>
        <!-- <div class="w3-row"> -->
           <label style=" font-size: 20px;">กรุณากรอกรายละเอียดของสินค้า พร้อมจำนวนที่ต้องการ และข้อมูลที่ชัดเจน เพื่อความเร็วในการเสนอราคา</label>
            <textarea class="w3-input" id="detail_mail" name="detail_mail" style="box-shadow: 0 0 3px #000000; margin: 10px; resize: none; height: 200px"></textarea>
        <!-- </div> -->
       <!-- <label>Subject</label> -->
       <div class="w3-row">
       <!-- <input type="hidden" name="button_pressed" value="1" /> -->
       <div class="w3-col"><center><button class="w3-btn" style="background-color: #ac2925; width: 70%; height: 40px; margin-top: 20px;" onclick="subEmailOrder()" ><font color='white'>กดส่ง เพื่อส่งขอใบเสนอราคาด่วน!!</font></button></center></div>
      
       </div>
      
    </div>
      


    <br><br>

    <script>

		function validateEmail(email) {
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}


    function subEmailOrder() {

            
			var com_name = $("#com_name").val();

			var contact = $("#contact").val();

			var email_name = $("#email_name").val();

			var phone_input = $("#phone_input").val();


			var detail_mail = $("#detail_mail").val();
			if (email_name == "") {
				alert("กรุณากรอก email ติดต่อกลับ");

				return  false;
                
			}
            if (phone_input == "") {
				alert("กรุณากรอกเบอร์ติดต่อ");

				return  false;
                
			}
            if (detail_mail == "") {
				alert("กรุณากรอกรายละเอียดสินค้า");

				return  false;
                
			}
            if (contact == "") {
				alert("กรุณากรอกชื่อผู้ติดต่อ");

				return  false;
                
			}
			if (!validateEmail(email_name)) {
				alert("กรุณากรอก email ให้ตรง format");

				return false;
			}
            
            var url_page = "";
			var url_page = "support_order.php";
			location.href = url_page + "?action=order_submit&com_name=" 
            + com_name + "&contact=" + contact+ "&email_name=" + email_name+ "&phone_input=" 
            + phone_input+ "&detail_mail=" + detail_mail;

            
			
		}
    </script>
</body>
<?
	if ($_GET["action"] == "order_submit") {
		require_once('./PHPMailer-master/src/PHPMailer.php');
		require_once('./PHPMailer-master/src/SMTP.php');
		require_once('./PHPMailer-master/src/Exception.php');
		// require 'vendor/autoload.php';
		// require 'PHPMailerAutoload.php';
		


        // Load Composer's autoloader
		// require 'vendor/autoload.php';

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		try {
			//Server settings
			// $mail->SMTPDebug = 2;                                       // Enable verbose debug output
			$mail->isSMTP();                                            // Set mailer to use SMTP
			$mail->Host       = 'mail.smartbestbuys.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'support@smartbestbuys.com';                     // SMTP username
			$mail->Password   = 'smart123456';                               // SMTP password
			$mail->Port = 465;
			$mail->SMTPSecure = 'ssl';
			$mail->SMTPAutoTLS = false;
			$mail->CharSet = 'UTF-8';
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			//Recipients
			$mail->setFrom('support@smartbestbuys.com','ลูกค้าขอใบเสนอราคาด่วนจากหน้าเว็บ');
			$mail->addAddress('sale@smartbestbuys.com');     // Add a recipient
			// Attachments  // Add attachments

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = '[Test]ใบเสนอราคาลูกค้า';
			$mail->Body    ='ขอใบเสนอราคาด่วน <br><br> ชื่อบริษัท | ชื่อหน่วยงาน : '.$_GET["com_name"].' <br> ชื่อผู้ติดต่อ : '.$_GET["contact"].' <br> Email : '.$_GET["email_name"].' <br> เบอร์ติดต่อกลับ : '.$_GET["phone_input"].' <br> รายละเอียด : '.$_GET["detail_mail"].'';
			// $mail->AltBody = 'Hi! This is my first e-mail sent through PHPMailer.';
			$mail->send();
			// echo 'Message has been sent';
			// header("location:index.php");
			?>
			<script>
				//$(document).ready(function(){
                jQuery.noConflict()
				$("#modalSubscriptionSuccessOrder").modal("toggle");
				//});
			</script>
		<?
		} catch (Exception $e) {
			//throw $th;
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
    }
?>
<?

include 'footer.php';
?>