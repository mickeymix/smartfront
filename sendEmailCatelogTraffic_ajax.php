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
try {
    //Server settings
    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'mail.smartbestbuys.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'info@smartbestbuys.com';                     // SMTP username
    $mail->Password = 'smart67890';                               // SMTP password
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
    $sql = "SELECT * FROM email_teamplate_master ";
    $queryEmail = mysqli_query($conn, $sql);
    echo "'".$_POST['email_customer']."'";
    $insertscript = "INSERT INTO email_customer(email, keyword,customer_name, insert_date) VALUES ('".$_POST['email_customer']."','Catalogs','".$_POST['customer_name']."',SYSDATE())";
    $conn->query($insertscript);
    while ($resultEmail = mysqli_fetch_assoc($queryEmail)) {
        /*                                ,'".<?php echo $row['paper_link']?>."','".<?php echo $row['paper_email_template']?>."','".<?php echo $row['paper_name']?>."'*/
        $mail->setFrom('info@smartbestbuys.com');
        $mail->addAddress($_POST['email_customer']);     // Add a recipient
        // Attachments
        $mail->AddEmbeddedImage('images/downlodcatalog_email.jpg', 'downlodcatalog_email');    // Add attachments

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $resultEmail['email_title'];
        $mail->Body = "<a href='https://drive.google.com/open?id=1bs6QYyIz99pztHGhEcA-LwCE--iKsgNm' target='_blank'><img src='cid:downlodcatalog_email'></a>";
        $mail->AltBody = $resultEmail['email_altMessage'];
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