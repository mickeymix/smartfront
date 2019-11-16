<?php
if (isset($_POST)) {

    include 'conn.php';
    header('Content-Type: application/json');
    $conn = mysqli_connect($host, $user, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");

    $arrayItems = $_POST['item'];
    $order = 0;


        foreach ($arrayItems as $item) {
            $sql = "UPDATE menu SET menu_order='$order' WHERE id_menu='$item'";
            mysqli_query($conn, $sql);
            $order++;
        }

    echo json_encode(array('status' => '1','message'=> 'Record add successfully'));
    mysqli_close($conn);
}


