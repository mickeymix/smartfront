<?php
header('Access-Control-Allow-Origin: *');
?>
<?php
include 'backoffice/conn.php';
require_once('./PHPMailer-master/src/PHPMailer.php');
require_once('./PHPMailer-master/src/SMTP.php');
require_once('./PHPMailer-master/src/Exception.php');
// require './vendor/autoload.php';
// require 'PHPMailerAutoload.php';



// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
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

    $conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");
    $sql5 = "SELECT * FROM white_paper_master where paper_id = '".$_GET['paper_id']."' limit 1";

    $sql = "INSERT INTO white_paper_download_master (download_name,download_email,download_paperid,download_source,download_date) VALUES ('".$_GET['nameInput']."','".$_GET['email']."','".$_GET['paper_id']."','".$_GET['pageSource']."',SYSDATE())";
    $conn->query($sql);

    $result5 = $conn->query($sql5);

    while ($row2 = $result5->fetch_assoc()) {
        /*                                ,'".<?php echo $row['paper_link']?>."','".<?php echo $row['paper_email_template']?>."','".<?php echo $row['paper_name']?>."'*/
        $paper_link = $row2['paper_link'];
        $paper_email_template = $row2['paper_email_template'];
        $paper_name = $row2['paper_name'];

        //Recipients
        $mail->setFrom('support@smartbestbuys.com','Whitepaper เรื่อง "'.$paper_name.'"');
        $mail->addAddress($_GET['email']);     // Add a recipient
        // Attachments  // Add attachments
        $mail->addAttachment("/var/www/test.smartbestbuy.com/public_html/white_paper/".$paper_link);     // Add attachments

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $paper_name;
        $mail->Body =$paper_email_template;
        $mail->send();
        // echo 'Message has been sent';
        // header("location:index.php");

        echo json_encode(array('status' => '1', 'message' => "success"));
    }
} catch (Exception $e) {
    //throw $th;
    echo json_encode(array('status' => '0','message'=> "Error insert data! '".$conn->error."'"));
}

?>