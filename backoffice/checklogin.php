<?
// ini_set('session.gc_maxlifetime', 5000000);
// session_set_cookie_params(50000000);
session_start();

?>
<?php

include 'conn.php';

$conn = mysqli_connect($host, $user, $pass, $dbname);
$username_log = $_POST["username_log"];
$password_log = $_POST["password_log"];

$sql = "SELECT * FROM admin_master Where adminusername='" . $username_log . "' and adminpassword='" . $password_log . "' ";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) == 1) {
    $_SESSION["username_log"] = $username_log;
    $row = mysqli_fetch_array($result);
    
    

    
    echo "<script> window.location ='ma_product.php'; </script> ";
 }else{
    $code_error = "username  password ไม่ถูกต้อง";
    //session_register("code_error");
    $_SESSION["code_error"] = $code_error;
    echo "<script> window.location ='index.php'; </script>";
 }



// if ($username_log == "admin" && $password_log == "admin") {
//     $_SESSION["username_log"] = $username_log;


//     echo "<script> window.location ='ma_product.php'; </script> ";
// } else if ($username_log == "admin_aui" && $password_log == "auiaui") {

//     $_SESSION["username_log"] = $username_log;


//     echo "<script> window.location ='ma_product.php'; </script> ";
// } else {
//     $code_error = "username  password ไม่ถูกต้อง";
//     //session_register("code_error");
//     $_SESSION["code_error"] = $code_error;
//     echo "<script> window.location ='index.php'; </script>";
// }
?>

