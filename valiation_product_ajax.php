<?php
include 'backoffice/conn.php';
header('Content-Type: application/json');

$conn = mysqli_connect($host, $user, $pass, $dbname);

mysqli_set_charset($conn, "utf8");
$sql5 = "SELECT * FROM valiation_answer_master where v_ori_id = '" . $_POST['idValiation'] . "' AND  v_option_one = '" . $_POST['valiationOne'] . "' ";
$queryEmail = mysqli_query($conn, $sql5);
while ($resultValiation = mysqli_fetch_assoc($queryEmail)) {
    $sql = "SELECT * FROM product_main where product_code='" . $resultValiation['v_sku'] . "'";
    $queryproduct = mysqli_query($conn, $sql);
    while ($resultprodut= mysqli_fetch_assoc($queryproduct)) {
        echo json_encode(array('status' => '1', 'message' => "success", 'productResult' => $resultprodut));
    }



}


?>