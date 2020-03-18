<?php
include 'backoffice/conn.php';
require_once('./PHPMailer-master/src/PHPMailer.php');
require_once('./PHPMailer-master/src/SMTP.php');
require_once('./PHPMailer-master/src/Exception.php');
// require 'vendor/autoload.php';
// require 'PHPMailerAutoload.php';


// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {                       // Enable verbose debug output
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
    $mail->setFrom('support@smartbestbuys.com','ลูกค้าขอใบเสนอราคาด่วนจากหน้าเว็บจาก "'.$_POST["com_name"].'"');
    $mail->addAddress('sale@smartbestbuys.com');     // Add a recipient
    // Attachments  // Add attachments

    // Content
    $mail->isHTML(true);
//    $mail-> = date("Y-m-d H:i:s").gettimeofday()["usec"];// Set email format to HTML
    $mail->Subject = '"[REQ_Smart'.randomNumber(7).']"ใบเสนอราคาลูกค้าจาก "'.$_POST["com_name"].'" ';
    $mail->Body    ='ขอใบเสนอราคาด่วน <br><br> ชื่อบริษัท | ชื่อหน่วยงาน : '.$_POST["com_name"].' <br> ชื่อผู้ติดต่อ : '.$_POST["contact"].' <br> Email : '.$_POST["email_name"].' <br> เบอร์ติดต่อกลับ : '.$_POST["phone_input"].' <br> รายละเอียด : '.$_POST["detail_mail"].'';
    // $mail->AltBody = 'Hi! This is my first e-mail sent through PHPMailer.';
    $mail->send();
    echo json_encode(array('status' => '1', 'message' => "success"));
} catch (Exception $e) {
    //throw $th;
    echo json_encode(array('status' => '0','message'=> "Error insert data! '".$conn->error."'"));
}
function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
?>