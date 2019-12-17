<?php
ob_start();
session_start();

include 'backoffice/conn.php';

if(!empty($_GET)) {
    if(!empty($_GET['action'])){
        if ($_GET["action"] == "logout") {
            session_destroy();
            header("Location: index.php");
        }
    }
}

if(!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
}

$customer_id = $_SESSION["customer_id"];
$customer_name = "";
$customer_email = "";

$conn = mysqli_connect($host, $user, $pass, $dbname);
mysqli_set_charset($conn, "utf8");

$sql = "select * from users where customer_id  = '". $customer_id ."'";
$query = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($query)) {
  $customer_name = $result['firstname']. "  " .$result['lastname'];
  $customer_email = $result['email'];
}


require_once('./PHPMailer-master/src/PHPMailer.php');
require_once('./PHPMailer-master/src/SMTP.php');
require_once('./PHPMailer-master/src/Exception.php');
// require 'vendor/autoload.php';
// require 'PHPMailerAutoload.php';
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    //Server settings
    $mail->SMTPDebug = 2; // Enable verbose debug output
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'mail.smartbestbuys.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'info@smartbestbuys.com'; // SMTP username
    $mail->Password = 'smart67890'; // SMTP password
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
    
    $Total = 0;
    $SumTotal = 0;

    // Set body email
    $bodyEmail  = "";

    $bodyEmail .= "<style>";
    $bodyEmail .= ".product_show_detail_ordre {";
    $bodyEmail .= "border: 1px;";
    $bodyEmail .= "";
    $bodyEmail .= "}";
    $bodyEmail .= "</style>";

    // Set customer detail
    $bodyEmail .= "<strong>ขอใบเสนอราคาด่วน</strong>";
    $bodyEmail .= "<br>";
    $bodyEmail .= "<strong>ชื่อบริษัท | ชื่อหน่วยงาน :</strong>". $_POST['com_name'];
    $bodyEmail .= "<br>";
    $bodyEmail .= "<strong>ชื่อผู้ติดต่อ :</strong>".$_POST['contact'];
    $bodyEmail .= "<br>";
    $bodyEmail .= "<strong>อีเมล์ : </strong>".$_POST['email_name'];
    $bodyEmail .= "<br>";
    $bodyEmail .= "<strong>เบอร์ติดต่อกลับ : </strong>".$_POST['phone_input'];
    $bodyEmail .= "<br>";
    $bodyEmail .= "<strong>รายละเอียด : </strong>".$_POST['detail_mail'];
    $bodyEmail .= "<br>";

    $bodyEmail .= "<table border='1' class='table table-border product_show_detail_ordre'>";
    $bodyEmail .= "<thead>";
    $bodyEmail .= "<tr>";
    $bodyEmail .= "<td class='product_show_detail_ordre'>";
    $bodyEmail .= "<strong>";
    $bodyEmail .= "รหัสสินค้า";
    $bodyEmail .= "</strong>";
    $bodyEmail .= "</td>";
    $bodyEmail .= "<td>";
    $bodyEmail .= "<strong>";
    $bodyEmail .= "ชื่อสินค้า";
    $bodyEmail .= "</strong>";
    $bodyEmail .= "</td>";
    $bodyEmail .= "<td>";
    $bodyEmail .= "<strong>";
    $bodyEmail .= "จำนวนสินค้า";
    $bodyEmail .= "</strong>";
    $bodyEmail .= "</td>";
    $bodyEmail .= "</tr>";
    $bodyEmail .= "</thead>";
    $bodyEmail .= "<tbody>";
        for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
        {
                if($_SESSION["product_code"][$i] != "")
                {
                    $bodyEmail .= "<tr>";
                    $bodyEmail .= "<td>";
                    $bodyEmail .= $_SESSION['product_code'][$i];
                    $bodyEmail .= "</td>";
                    $bodyEmail .= "<td>";
                    $bodyEmail .=  $_SESSION['product_name'][$i];
                    $bodyEmail .= "</td>";
                    $bodyEmail .= "<td>";
                    $bodyEmail .= "<strong>".  $_SESSION['product_amount'][$i]. "</strong>";
                    $bodyEmail .= "</td>";
                    $bodyEmail .= "</tr>";

                    $SumTotal +=  1; // $_SESSION['product_amount'][$i];
                
                }
        }
        $bodyEmail .= "</tbody>";
        $bodyEmail .= "</table>";
        $bodyEmail .= "<br/>";
        // $bodyEmail .= "รวมรายการทั้งหมด ". $SumTotal. "  รายการ ";
        // End set body email

        //Recipients Test
        // $mail->setFrom("sale@smartbestbuys.com");
        // $mail->addAddress($customer_email);     
        // Add a recipient
        
        
        // Send mail on product.
        $mail->setFrom($customer_email);
        $mail->addAddress("sale@smartbestbuys.com");
        

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "ใบเสนอราคา คุณ ". $customer_name ;
        $mail->Body = $bodyEmail;
        $mail->send();
      
        // clear session product order.
        for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
        {
            unset($_SESSION['product_code'][$i]); 
            unset($_SESSION['product_image'][$i]);
            unset($_SESSION['product_amount'][$i]);
            unset($_SESSION['intLine'][$i]);
        }
        
        unset($_SESSION['intLine']);
        unset($_SESSION['product_code']); 
        unset($_SESSION['product_image']);
        unset($_SESSION['product_amount']);

    mysqli_close($conn);
    header("location:index.php");
} catch (Exception $e) {
    //  throw $th;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    กำลังดำเนินการแจ้งรายการทางอีเมล์
</body>
</html>